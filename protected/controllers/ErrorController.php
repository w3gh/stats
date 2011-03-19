<?php

/**
 * ErrorController class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://w3gh.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * Description of ErrorController
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @version $Id:$
 * @package 
 */
class ErrorController extends Controller {

  public function actionIndex() {
    if ($error = Yii::app()->errorHandler->error) {
      //var_dump($error);
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else {
        //var_dump($error);
        $this->pageTitle = Yii::t('site', 'Error ' . $error['code']);
        $this->breadcrumbs->mergeWith(array(Yii::t('site', 'Error ' . $error['code'])));
        $this->render('error', $error);
      }
    }
  }

}
