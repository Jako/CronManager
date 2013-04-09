<?php
$xpdo_meta_map['modCronjobLog']= array (
  'package' => 'cronmanager',
  'version' => NULL,
  'table' => 'cronjobs_log',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'cronjob' => NULL,
    'message' => NULL,
    'logdate' => NULL,
    'error' => 0,
    'start_time' => NULL,
    'memory_peak' => 0,
    'status' => 'Started',
    'execution_time' => 0,
  ),
  'fieldMeta' => 
  array (
    'cronjob' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'message' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'logdate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'error' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'start_time' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'memory_peak' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,3',
      'phptype' => 'float',
      'null' => true,
      'default' => 0,
    ),
    'status' => 
    array (
      'dbtype' => 'set',
      'precision' => '\'Started\',\'Completed\'',
      'phptype' => 'string',
      'null' => true,
      'default' => 'Started',
    ),
    'execution_time' => 
    array (
      'dbtype' => 'float',
      'precision' => '10,3',
      'phptype' => 'float',
      'null' => true,
      'default' => 0,
    ),
  ),
  'indexes' => 
  array (
    'CronJog' => 
    array (
      'alias' => 'CronJog',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'cronjob' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'Preformance' => 
    array (
      'alias' => 'Preformance',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'cronjob' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'memory_peak' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => true,
        ),
        'status' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => true,
        ),
        'execution_time' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => true,
        ),
      ),
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
