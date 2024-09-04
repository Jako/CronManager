<?php
/**
 * Run the cronjobs
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\Processor;

class CronMananagerCronRunProcessor extends Processor
{
    /**
     * @return string|void
     */
    public function process()
    {
        // Check cronjob_id in no cli mode
        if (php_sapi_name() != 'cli' &&
            (!isset($_REQUEST['cronjob_id']) || $_REQUEST['cronjob_id'] !== $this->cronmanager->getOption('cronjob_id'))
        ) {
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'The request parameter for cron.php is not set or not equal to the system setting cronmanager.cronjob_id.', '', 'CronManager');
            return '';
        }

        $success = true;

        $success = $this->purgeRunning($success);
        $success = $this->runCronjobs($success);

        if (php_sapi_name() != 'cli') {
            @session_write_close();
            if (isset($_REQUEST['force']) && $_REQUEST['force']) {
                exit(json_encode([
                    'success' => true
                ]));
            } else {
                exit(isset($rundatetime) ? $rundatetime : date('Y-m-d H:i:s'));
            }
        } else {
            exit($success ? 0 : 1);
        }
    }

    /**
     * @param bool $success
     * @return bool
     */
    private function runCronjobs($success)
    {
        // Determine all cronjobs that need to be executed
        $c = $this->modx->newQuery('modCronjob');
        $c->where([
            'active' => true,
            'running' => false,
        ]);
        if (!isset($_REQUEST['force']) || !$_REQUEST['force']) {
            $c->where([
                [
                    'nextrun' => null,
                    'OR:nextrun:<=' => date('Y-m-d H:i:s'),
                ],
            ]);
        }
        if (isset($_REQUEST['job']) && $_REQUEST['job']) {
            $c->where([
                'id' => intval($_REQUEST['job'])
            ]);
        }
        $c->sortby('nextrun');

        /** @var modCronjob $cronjob */
        $cronjobs = $this->modx->getIterator('modCronjob', $c);
        foreach ($cronjobs as $cronjob) {
            $rundatetime = ($cronjob->get('nextrun')) ? $cronjob->get('nextrun') : date('Y-m-d H:i:s');
            $properties = $cronjob->get('properties');
            if (!empty($properties)) {
                /** @var modPropertySet $propset */
                $propset = $this->modx->getObject('modPropertySet', ['name' => $properties]);
                if (!empty($propset) && $propset instanceof modPropertySet) {
                    $properties = $propset->getProperties();
                } elseif (json_decode($properties)) {
                    $tempProps = json_decode($properties, true);
                    $properties = (!empty($tempProps) && is_array($tempProps)) ? $tempProps : [];
                } else {
                    $lines = explode("\n", $properties);
                    $properties = [];
                    foreach ($lines as $line) {
                        list($key, $value) = explode(':', $line);
                        $properties[trim($key)] = trim($value);
                    }
                }
            } else {
                $properties = [];
            }
            $properties['CronManager'] = '1';
            if ($this->cronmanager->getOption('pass_modcronjob')) {
                $properties['CronManagerJob'] = $cronjob;
            }

            if ($this->cronmanager->getOption('debug')) {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'CronManager Job: ' . $cronjob->get('title') . ' (' . $cronjob->get('id') . ') properties: ' . print_r($properties, true), '', 'CronManager');
            }
            $this->modx->resource = $this->modx->getObject('modResource', $this->modx->getOption('site_start'));

            /** @var modSnippet $snippet */
            $snippet = $cronjob->getOne('Snippet');
            /**
             * The snippet should output a json array: array('error' => boolean,
             * 'message' => string). If this is not the case, the snippet output is set
             * as message. This makes it possible to indicate in the snippet output
             * whether an error has occurred. This makes it easier to filter logs.
             */
            try {
                $cronjob->set('running', true);
                $cronjob->save();

                $response = $snippet->process($properties);
                if (json_decode($response)) {
                    $response = json_decode($response, true);
                } else {
                    $response = [
                        'error' => false,
                        'message' => ($response) ?: 'No snippet output!'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'error' => true,
                    'message' => 'Error: ' . $e->getMessage(),
                ];
                $success = false;
            }

            // Add result to log
            /** @var modCronjobLog $log */
            $log = $this->modx->newObject('modCronjobLog');
            $log->fromArray($response);
            $log->set('logdate', $rundatetime);
            $logs = [$log];

            $cronjob->set('lastrun', $rundatetime);
            $cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime) + ($cronjob->get('minutes') * 60))));
            $cronjob->set('running', false);
            $cronjob->addMany($logs);
            $cronjob->save();
        }
        return $success;
    }

    /**
     * @param bool $success
     * @return bool
     */
    private function purgeRunning($success)
    {
        $c = $this->modx->newQuery('modCronjob');
        $c->where([
            'active' => true,
            'running' => true,
            'lastrun:<=' => date('Y-m-d H:i:s', strtotime('-' . $this->cronmanager->getOption('purge_running') . ' minutes')),
        ]);
        $cronjobs = $this->modx->getIterator('modCronjob', $c);
        foreach ($cronjobs as $cronjob) {
            $cronjob->set('running', false);
            $cronjob->save();
        }

        return $success;
    }
}

return 'CronMananagerCronRunProcessor';
