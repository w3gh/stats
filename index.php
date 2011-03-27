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

$app = Yii::createWebApplication($config);

define('BASEURL', Yii::app()->baseUrl);

function d()
{
  echo '<pre>';
  $_ = func_get_args();
  echo call_user_func_array(
    array('CVarDumper', 'dump'), $_
  );
  exit();
}

/* @var $app CWebApplication */

// Language
if ($app->session->itemAt('language'))
{
  $app->setLanguage($app->session->itemAt('language'));
}
elseif ($app->request->preferredLanguage && is_dir('protected/messages/' . $app->request->preferredLanguage))
{
  $app->setLanguage($app->request->preferredLanguage);
}
else
{
  $app->setLanguage('en_us');
}

// Theme
$theme = $app->session->itemAt('theme') ? $app->session->itemAt('theme') : 'standard';
$app->setTheme($theme);

// Unset jQuery in Ajax requests
if ($app->request->isAjaxRequest)
{
  $app->clientScript->scriptMap['jquery.js'] = false;
  $app->clientScript->scriptMap['jquery.min.js'] = false;
}

// Publish messages for javascript usage
///Yii::app()->getComponent('messages')->publishJavaScriptMessages();

header("Content-Type:	text/html; charset=utf-8");
//Run Dispatch
$app->run();
