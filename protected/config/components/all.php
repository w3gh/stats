<?php

return array(
  'ranker' => array(
    'class' => 'application.modules.ghpp.components.GRank.GRank',
    'modelClass' => 'Players',
    'rankMethod' => 'Elo',
    'ranker' => array(
      'xpModifier' => 1.0,
      'goldModifier' => 1.0,
      'avgXPKill' => 1716.667,
      'avgGoldKill' => 640.0,
      'avgXPDeath' => 2203.0,
      'avgGoldDeath' => 640.0,
      'avgXPAssist' => 858.333,
      'avgGoldAssist' => 0.0,
      'avgXPCreep' => 58.202,
      'avgGoldCreep' => 29.152,
      'avgXPNeutral' => 70.0,
      'avgGoldNeutral' => 40.0,
    ),
  ),
  'viewRenderer' => array(
    'class' => 'CPradoViewRenderer',
  ),
  'user' => array(
    // enable cookie-based authentication
    'allowAutoLogin' => true,
  ),
  'db' => require(dirname(__FILE__) . '/db.php'),
  'errorHandler' => array(
    // use 'site/error' action to display errors
    'errorAction' => 'error',
  ),
  'var' => array(
    'class' => 'system.caching.CDbCache',
    'connectionID' => 'db',
    'cacheTableName' => 'variables',
    'autoCreateCacheTable' => true,
  ),
  'cache' => array(
    'class' => 'system.caching.CFileCache',
    'cachePath'=>dirname(__FILE__).'../../../runtime/filecache',
  ),
  'urlManager' => array(
    'class' => 'CUrlManager',
    'urlFormat' => 'path',
    'rules' => array(
      'bans/*' => 'ghpp/default/bans',
      'admins/*' => 'ghpp/default/admins',
      'players/*' => 'ghpp/default/player',
      'gii' => 'gii',
      'gii/<controller:\w+>' => 'gii/<controller>',
      'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
//        'tag/<tag>'=>'post/list',
//        'posts'=>'post/list',
//        'post/<id:\d+>'=>'post/show',
//        'post/update/<id:\d+>'=>'post/update',
    ),
  ),
  'messages' => array(
    'class' => 'CPhpMessageSource',
  ),
);
