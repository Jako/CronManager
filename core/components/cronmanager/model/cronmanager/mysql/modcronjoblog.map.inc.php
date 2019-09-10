<?php
/**
 * @package cronmanager
 */
$xpdo_meta_map['modCronjobLog']= array (
  'package' => 'cronmanager',
  'version' => '1.1',
  'table' => 'cronjobs_log',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'cronjob' => 0,
    'message' => '',
    'logdate' => NULL,
    'error' => 0,
  ),
  'fieldMeta' => 
  array (
    'cronjob' => 
    array (
      'dbtype' => 'integer',
      'precision' => '11',
      'phptype' => 'string',
      'null' => false,
      'default' => 0,
    ),
    'message' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'logdate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'error' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'Cronjob' => 
    array (
      'class' => 'modCronjob',
      'local' => 'cronjob',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
