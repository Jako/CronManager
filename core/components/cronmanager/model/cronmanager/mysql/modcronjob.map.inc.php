<?php
$xpdo_meta_map['modCronjob']= array (
  'package' => 'cronmanager',
  'table' => 'cronjobs',
  'fields' => 
  array (
    'snippet' => 0,
    'properties' => 'null',
    'minutes' => 60,
    'lastrun' => 'null',
    'nextrun' => 'null',
    'sortorder' => 0,
    'active' => 0,
  ),
  'fieldMeta' => 
  array (
    'snippet' => 
    array (
      'dbtype' => 'integer',
      'precision' => '11',
      'phptype' => 'string',
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
      'phptype' => 'boolean',
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
