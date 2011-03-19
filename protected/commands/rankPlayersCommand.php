<?php
/**
 * rankPlayersCommand class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * rankPlayersCommand represents a console rank command.
 *
 * rankPlayersCommand starts counting the rankings for all players
 *
 * To use this command, enter the following on the command line:
 * <pre>
 * php path/to/entry_script.php rankPlayers [process capacity]
 * </pre>
 * If process capacity is not specified, will be ranked all players (not recomended).
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @version $Id:$
 * @package application.commands
 */
class rankPlayersCommand extends CConsoleCommand
{
	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{   
    $cap = isset($args[0]) ? (int)$args[0] : 5;
    Yii::app()->ranker->run($cap);
	}

	/**
	 * Provides the command description.
	 * @return string the command description.
	 */
	public function getHelp()
	{
		return <<<EOD
USAGE
  yiic rankPlayers <process-cap-number>

DESCRIPTION
  This command starts counting the rankings for all players.

PARAMETERS
 - <process-cap-number>: defines how many games will be ranked per once.

EOD;
	}
}
