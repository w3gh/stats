<?php

class InstallController extends PublicController
{
    public $layout='//layouts/install';

	public function actionIndex()
	{
        $this->redirect('install/license');
//        switch($step)
//        {
//            case 'license':
//                $this->render('index');
//                break;
//            case 'site':
//                $this->render('index');
//                break;
//            case 'database':
//                $this->render('index');
//                break;
//            case 'permissions':
//                $this->render('index');
//                break;
//            case 'admin':
//                $this->render('index');
//                break;
//            case 'finish':
//                break;
//            case 'flush':
//                break;
//
//
//        }
//
		$this->render('index');
	}

    public function actionLicense()
    {
        $this->render('license');
    }

    public function actionSite()
    {
        $this->render('site');
    }

    public function actionDatabase()
    {
        $this->render('database');
    }

    public function actionPermissions()
    {
        $this->render('permissions');
    }

    public function actionAdmin()
    {
        $this->render('admin');
    }

    public function actionFinish()
    {
        $this->render('finish');
    }

    public function actionFlush()
    {
        $this->render('flush');
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}