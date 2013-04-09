<?php
$xpdo_meta_map['modCronjob']= array (
  'package' => 'cronmanager',
  'version' => NULL,
  'table' => 'cronjobs',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'title' => NULL,
    'description' => NULL,
    'snippet' => 0,
    'properties' => 'null',
    'minutes' => 60,
    'lastrun' => 'null',
    'nextrun' => 'null',
    'sortorder' => 0,
    'active' => 0,
    'debug' => 0,
    'set_nextrun' => 'Success',
    'auto_clearlogs' => 0,
  ),
  'fieldMeta' => 
  array (
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '64',
      'phptype' => 'string',
      'null' => true,
    ),
    'description' => 
    array (
      'dbtype' => 'mediumtext',
      'phptype' => 'string',
      'null' => true,
    ),
    'snippet' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'properties' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => 'null',
    ),
    'minutes' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 60,
    ),
    'lastrun' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'default' => 'null',
    ),
    'nextrun' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'default' => 'null',
    ),
    'sortorder' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'active' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'debug' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'set_nextrun' => 
    array (
      'dbtype' => 'set',
      'precision' => '\'Load\',\'Success\'',
      'phptype' => 'string',
      'null' => false,
      'default' => 'Success',
    ),
    'auto_clearlogs' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'Log' => 
    array (
      'class' => 'modCronjobLog',
      'local' => 'id',
      'foreign' => 'cronjob',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Snippet' => 
    array (
      'class' => 'modSnippet',
      'local' => 'snippet',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
