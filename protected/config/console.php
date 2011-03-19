<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray(
  require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php',
  array(
    'name' => 'My Console Application',
  )
);