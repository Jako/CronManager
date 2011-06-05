<?php

require_once MODX_CORE_PATH . 'model/modx/modrequest.class.php';

class cronmanagerControllerRequest extends modRequest
{
    public $cronmanager = null;
    public $actionVar = 'action';
    public $defaultAction = 'index';
 
    function __construct(CronManager &$cronmanager) {
        parent::__construct($cronmanager->modx);
        $this->cronmanager =& $cronmanager;
    }
 
    public function handleRequest() {
        $this->loadErrorHandler();
 
        /* save page to manager object. allow custom actionVar choice for extending classes. */
        $this->action = isset($_REQUEST[$this->actionVar]) ? $_REQUEST[$this->actionVar] : $this->defaultAction;
 
        $modx =& $this->modx;
        $cronmanager =& $this->cronmanager;
        $viewHeader = include $this->cronmanager->config['corePath'].'controllers/mgr/header.php';
 
        $f = $this->cronmanager->config['corePath'].'controllers/mgr/'.$this->action.'.php';
        if (file_exists($f)) {
            $viewOutput = include $f;
        } else {
            $viewOutput = 'Controller not found: '.$f;
        }
 
        return $viewHeader.$viewOutput;
    }
}

?>