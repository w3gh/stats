<?php
/**
 * 
 */

return array(
  'connectionString' => 'mysql:host=localhost;dbname=ghpp', //mysql:host=yourdatabasehost;dbname=yourdbname
  'username' => 'ghpp', //your database username
  'password' => 'ghpppass', //your database password

  'charset'=>'utf8',
  'emulatePrepare' => true,
  'tablePrefix' => '',
  
  'enableParamLogging'=>YII_DEBUG,
  'enableProfiling'=>YII_DEBUG,

  'schemaCacheID'=>'cache',
  'schemaCachingDuration'=>1800,
  'persistent'=>true,
);