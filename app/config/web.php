<?php

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'W3Gh Stats',
    'theme' => 'classic',

    'defaultController'=>'news/default/index',
    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.widgets.*'
    ),

    'modules'=>array(
        'user',
        'ghost',
        'news',
        'ranker',
        'comment'=>array(
            'commentableModels'=>array('News','Players','Games')
        ),

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'enabled'=>YII_DEBUG,
            'password'=>'123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),

    ),

    // application components
    'components'=>array(

        'user'=>array(
            'class'=>'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),

        'authManager'=>array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),

        'themeManager' => array(
            'themeClass'=>'Theme',
        ),

        'format'=>array(
            'class'=>'system.utils.CFormatter'
        ),

        'widgetFactory'=>array(
            'enableSkin'=>true,
        ),

        'urlManager'=>array(
            'urlFormat'=>'path',
            'urlSuffix'=>'.html',
            'showScriptName'=>false,
            //'showScriptName'=>false, //use it only if .htaccess has right rule
            'rules'=>array(

                'page/<id:\w+>'=>'site/page',
                'contact'=>'site/contact',

                'login'=>'user/default/login',
                'logout'=>'user/default/logout',

                'news/index'=>'news/default/index',
                'news/<id:\d+>'=>'news/default/view',

                'games/index'=>'ghost/games/index',
                'games/<id:\d+>'=>'ghost/games/view',

                'items/index'=>'ghost/items/index',
                'items/<id>'=>'ghost/items/view',

                'players/index'=>'ghost/players/index',
                'players/<id>'=>'ghost/players/view',

                'servers/index'=>'ghost/servers/index',
                'servers/<id>'=>'ghost/servers/view',

                'bots/index'=>'ghost/bots/index',
                'bots/<id>'=>'ghost/bots/view',

                'heroes/index'=>'ghost/heroes/index',
                'heroes/<id>'=>'ghost/heroes/view',
                'heroes/player/<player>'=>'ghost/heroes/index',

                'admin/<controller>'=>'<controller>/admin',
                'admin/<controller>/create'=>'<controller>/create',
                'admin/<controller>/update/<id>'=>'<controller>/update',
                'admin/<controller>/delete/<id>'=>'<controller>/delete',
                'admin/<controller>/view/<id>'=>'<controller>/view'

//      '<controller:\w+>/' => '<controller>/index',
//			'<controller:\w+>/<id:\w+>'=>'<controller>/view',
//		  '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//			'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

            ),
        ),

        'db'=>require(dirname(__FILE__).'/components/db.php'),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                    'enabled'=>!YII_DEBUG,
                ),

                array(
                    'class'=>'CWebLogRoute',
                    'enabled'=>YII_DEBUG,
                ),

            ),
        ),

        'cache' => array(
            'class' => 'CFileCache',
        ),

        // View Renderer (template engine)
        'viewRenderer' => array(
            'class' => 'CPradoViewRenderer',
        ),

    ),

    // application-level parameters that can be accessed
    // using param('paramName')
    'params'=>array(
        'dateFormat'=>'d.m.Y H:i',
        'newsPerPage'=>10,
        'gamesPerPage'=>10,
        'playersPerPage'=>10,
        'heroesPerPage'=>10,
        'itemsPerPage'=>10,
        'bansPerPage'=>10,

        'heroGameHistoryPerPage'=>10,

        'minGamesCount'=>3,

        'pageCacheTime' => 900, //15 min

        'showItemsMostUsedByHero'=>true,
        'showAllSlotsInGame' => true,
        'minPlayedRatio'=> '0.8',

        'headAdmin'=>'JiLiZART',
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',

        'analyticsAccount'=>false,//paste ID from analytics.google.com
    ),
);
