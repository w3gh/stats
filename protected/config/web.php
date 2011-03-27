<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
  require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php',
  array(
    'name' => 'Warcraft III Game Host Stats',
    'theme' => 'standard',
    'defaultController'=>'post',
    'preload' => array('log'),
    
    'components'=>array(
      'log' => array(
        'class' => 'CLogRouter',
        'enabled' => TRUE,
        'routes' => array(
          array(
            'class' => 'CFileLogRoute',
            //'levels'=>'error, warning',
          ),
          array(
            'class' => 'CProfileLogRoute',
          ),
          array(
            'class' => 'CWebLogRoute',
            'levels' => 'trace, warning, error, info', //'trace, warning, error, info, profile'
            //'showInFireBug'=>TRUE,
            'enabled' => YII_DEBUG,
          ),
        )
      ),
    ),
));