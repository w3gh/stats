<?php

class PvpgnModule extends CWebModule
{
	/**
	 * @var Filesystem Path to PvPGN Server
	 */
	public $serverPath = '/usr/local/pvpgn/';

	/**
	 * @var string Path to the server.dat file inside Server Path
	 */
	public $serverDatFile = 'var/status/server.dat';

	/**
	 * @var Server Ip
	 */
	public $serverIp;

	/**
	 * @var ServerPort
	 */
	public $serverPort;

	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			$this->name.'.models.*',
			$this->name.'.components.*',
			$this->name.'.components.widgets.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	/**
	 * Opens connection to the server and check status
	 * @return resource|boolean
	 */
	public function getServerStatus()
	{
		$fp = @fsockopen($this->serverIp || 'localhost', $this->serverPort || 6112, $errno, $errstr, $timeout);
		fclose($fp);
		return $fp;
	}

	/**
	 * Parses server.dat file and return readable array
	 * @param $filename
	 * @return array|bool
	 */
	protected function parseStatusFile($filename)
	{
		if(!is_file($filename) && !is_readable($filename))
			return FALSE;

		$ini_array = array();
		$lines = file($filename);
		foreach($lines as $line) {
			$line = trim($line);
			if ($line == "") {
				continue;
			} else if ($line[0] == "[" && $line[strlen($line) - 1] == "]") {
				$sec_name = substr($line, 1, strlen($line) - 2);
			} else {
				$pos = strpos($line, "=");
				$property = substr($line, 0, $pos);
				$value = substr($line, $pos + 1);
				if ($sec_name == 'USERS' || $sec_name == 'GAMES') {
					list($ini_array[$sec_name][$property]['ctag'],$ini_array[$sec_name][$property]['name']) = explode(',',$value);
				} else {
					$ini_array[$sec_name][$property] = $value;
				}
			}
		}
		return $ini_array;
	}

}
