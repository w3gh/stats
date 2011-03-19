<?php
/**
 * BnBotCommand class file.
 *
 * @author Nicholas Kostyurin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version $Id: $
 */


class BnBotCommand extends CConsoleCommand {

	public function getHelp()
	{
	 return <<< EOD
USAGE

DESCRIPTION
 This is a Battle.net Telnet based bot

PARAMETERS

EOD;

	}

	public function run($args) {
    if(!isset($args[0]))
      $args[0]='bnbot.php';
    $entryScript=isset($args[0]) ? $args[0] : 'index.php';
    if(($entryScript=realpath($args[0]))===false || !is_file($entryScript))
      $this->usageError("{$args[0]} does not exist or is not an entry script file.");

    ob_start();
    $config=require($entryScript);
    ob_end_clean();

    // oops, the entry script turns out to be a config file
    if(is_array($config))
    {
      chdir($cwd);
      $_SERVER['SCRIPT_NAME']='/index.php';
      $_SERVER['REQUEST_URI']=$_SERVER['SCRIPT_NAME'];
      $_SERVER['SCRIPT_FILENAME']=$cwd.DIRECTORY_SEPARATOR.'index.php';
      Yii::createWebApplication($config);
    }

    restore_error_handler();
    restore_exception_handler();

    $yiiVersion=Yii::getVersion();
    echo <<<EOD
Yii Interactive Tool v1.1 (based on Yii v{$yiiVersion})
Please type 'help' for help. Type 'exit' to quit.
EOD;
    $this->runBnBot();
	}


 /**
   * Reads input via the readline PHP extension if that's available, or fgets() if readline is not installed.
   * @param string prompt to echo out before waiting for user input
   * @return mixed line read as a string, or false if input has been closed
   */
  protected function readline($prompt)
  {
    if (extension_loaded('readline'))
    {
      $input = readline($prompt);
      readline_add_history($input);
      return $input;
    }
    else
    {
      echo $prompt;
      return fgets(STDIN);
    }
  }

	protected function runBnBot()
	{

		error_reporting(E_ALL ^ E_NOTICE);
    $_runner_=new CConsoleCommandRunner;
    $_runner_->addCommands(dirname(__FILE__).'/bnbot');
    $_runner_->addCommands(Yii::getPathOfAlias('application.commands.bnbot'));
    if(($_path_=@getenv('YIIC_SHELL_COMMAND_PATH'))!==false)
      $_runner_->addCommands($_path_);
    $_commands_=$_runner_->commands;

	  while(($_line_=$this->readline("\n>> "))!==false)
    {
      $_line_=trim($_line_);
      try
      {
        $_args_=preg_split('/[\s,]+/',rtrim($_line_,';'),-1,PREG_SPLIT_NO_EMPTY);
        if(isset($_args_[0]) && isset($_commands_[$_args_[0]]))
        {
          $_command_=$_runner_->createCommand($_args_[0]);
          array_shift($_args_);
          $_command_->run($_args_);
        }
        else
          echo eval($_line_.';');
      }
      catch(Exception $e)
      {
        if($e instanceof ShellException)
          echo $e->getMessage();
        else
          echo $e;
      }
    }

	}
}