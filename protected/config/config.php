<?php

return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  // preloading 'log' component
  //'preload' => array('log'),
  //'defaultController'=>'site',
  // autoloading model and component classes
  'import' => array(
    'application.models.*',
    'application.components.*',
    'application.components.widgets.*',
    'application.modules.ghpp.models.*',
    'application.modules.ghpp.components.*',
    'application.modules.ghpp.components.GHtml.*',
    'application.modules.ghpp.components.GRank.*',
    'application.modules.ghpp.components.GRank.methods.*',
    'zii.widgets.*',
  ),
  // application components
  'components' => require(dirname(__FILE__) . '/components/all.php'),
  'modules' => array(
    'ghpp' => array(
//      'playersPerPage'=>40,
//      'gamesPerPage'=>40,
//      'adminsPerPage'=>40,
//      'bansPerPage'=>40,
    ),
    'gii' => array(
      'class' => 'system.gii.GiiModule',
      'password' => '123',
    ),
  ),
  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params' => array(
    'postsPerPage' => 10,
    'tagCloudCount' => 10,
    'recentCommentCount' => 10,
    // this is used in contact page

    'dataCacheTime' => 3600,
    'pageCacheTime' => 1800,
    

    'adminEmail' => 'webmaster@example.com',
  ),
);
