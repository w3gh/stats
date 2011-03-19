<?php
/* 
 * chatbotCommand class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://w3gh.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */


class ChatbotCommand extends CConsoleCommand
{

	public function getHelp()
	{
		return <<<EOD
USAGE
  chatbot <path-to-config>
    
DESCRIPTION
  This command generates a controller and views associated with
  the specified actions.

PARAMETERS
 * controller-ID: required, controller ID, e.g., 'post'.
   If the controller should be located under a subdirectory,
   please specify the controller ID as 'path/to/ControllerID',
   e.g., 'admin/user'.

   If the controller belongs to a module, please specify
   the controller ID as 'ModuleID/ControllerID' or
   'ModuleID/path/to/Controller' (assuming the controller is
   under a subdirectory of that module).

EXAMPLES
 * Generates the 'post' controller:
        controller post

NOTE: in the last two examples, the commands are the same, but
the generated controller file is located under different directories.
Yii is able to detect whether 'admin' refers to a module or a subdirectory.

EOD;
	}

	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{
		if(!isset($args[0]))
		{
			echo "Error: config path is required.\n";
			echo $this->getHelp();
			return;
		}

		$module=Yii::app();
		$controllerID=$args[0];
		if(($pos=strrpos($controllerID,'/'))===false)
		{
			$controllerClass=ucfirst($controllerID).'Controller';
			$controllerFile=$module->controllerPath.DIRECTORY_SEPARATOR.$controllerClass.'.php';
			$controllerID[0]=strtolower($controllerID[0]);
		}
		else
		{
			$last=substr($controllerID,$pos+1);
			$last[0]=strtolower($last[0]);
			$pos2=strpos($controllerID,'/');
			$first=substr($controllerID,0,$pos2);
			$middle=$pos===$pos2?'':substr($controllerID,$pos2+1,$pos-$pos2);

			$controllerClass=ucfirst($last).'Controller';
			$controllerFile=($middle===''?'':$middle.'/').$controllerClass.'.php';
			$controllerID=$middle===''?$last:$middle.'/'.$last;
			if(($m=Yii::app()->getModule($first))!==null)
				$module=$m;
			else
			{
				$controllerFile=$first.'/'.$controllerClass.'.php';
				$controllerID=$first.'/'.$controllerID;
			}

			$controllerFile=$module->controllerPath.DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$controllerFile);
		}

		$args[]='index';
		$actions=array_unique(array_splice($args,1));

		$templatePath=$this->templatePath===null?YII_PATH.'/cli/views/shell/controller':$this->templatePath;

		$list=array(
			basename($controllerFile)=>array(
				'source'=>$templatePath.DIRECTORY_SEPARATOR.'controller.php',
				'target'=>$controllerFile,
				'callback'=>array($this,'generateController'),
				'params'=>array($controllerClass, $actions),
			),
		);

		$viewPath=$module->viewPath.DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$controllerID);
		foreach($actions as $name)
		{
			$list[$name.'.php']=array(
				'source'=>$templatePath.DIRECTORY_SEPARATOR.'view.php',
				'target'=>$viewPath.DIRECTORY_SEPARATOR.$name.'.php',
				'callback'=>array($this,'generateAction'),
				'params'=>array('controller'=>$controllerClass, 'action'=>$name),
			);
		}

		$this->copyFiles($list);

		if($module instanceof CWebModule)
			$moduleID=$module->id.'/';
		else
			$moduleID='';

		echo <<<EOD

Controller '{$controllerID}' has been created in the following file:
    $controllerFile

You may access it in the browser using the following URL:
    http://hostname/path/to/index.php?r={$moduleID}{$controllerID}

EOD;
	}

	public function generateController($source,$params)
	{
		if(!is_file($source))  // fall back to default ones
			$source=YII_PATH.'/cli/views/shell/controller/'.basename($source);
		return $this->renderFile($source,array('className'=>$params[0],'actions'=>$params[1]),true);
	}

	public function generateAction($source,$params)
	{
		if(!is_file($source))  // fall back to default ones
			$source=YII_PATH.'/cli/views/shell/controller/'.basename($source);
		return $this->renderFile($source,$params,true);
	}

}