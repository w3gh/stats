<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/app/framework/yii.php';
$config=dirname(__FILE__).'/app/config/web.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',(file_exists('.debug')) ? true:false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

/**
 * Debug function alias
 * @see CVarDumper::dump()
 */
function d()
{
	return call_user_func_array('CVarDumper::dump',func_get_args());
}

/**
 * Short Application alias
 * @see Yii::app()
 * @return CWebApplication the application singleton, null if the singleton has not been created yet.
 */
function app()
{
	return Yii::app();
}

/**
 * Fast access to Application params
 * @param string $param index name of Yii::app()->params array
 * @param bool $default Used if $param not found
 * @return mixed
 */
function param($param,$default=FALSE)
{
	return (app()->params[$param]) ? app()->params[$param] : $default;
}

/**
 * Translate function short alias
 * @see Yii::t()
 * @return string
 */
function __()
{
	$args = func_get_args();
	return call_user_func_array('Yii::t',$args);
}

$app->run();