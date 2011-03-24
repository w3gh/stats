<?php

define('CONSOLE', FALSE);

// remove the following line when in production mode
define('YII_DEBUG', TRUE);
define('YII_ENABLE_EXCEPTION_HANDLER', TRUE);
define('YII_ENABLE_ERROR_HANDLER', TRUE);

// change the following paths if necessary
//Base Framework Path
$yii = dirname(__FILE__) . '/framework/yii.php';
//Path to config for Web Application
$config = dirname(__FILE__) . '/protected/config/web.php';


require_once($yii);
//var_dump(require_once($config)); die();

$app=Yii::createWebApplication($config);

/* @var $app CWebApplication */

$lang=Yii::app()->request->preferredLanguage;

//Detect Browser Language and apply it to Application
$app->language=$lang;

header("Content-Type:	text/html; charset=utf-8");
//Run Dispatch
$app->run();
