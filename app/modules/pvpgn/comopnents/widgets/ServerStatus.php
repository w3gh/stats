<?php

/**
 *
 */
class ServerStatus extends Portlet
{

	/**
	 * Check availability of server
	 * @return boolean 
	 */
	protected function getStatus() {
		return app()->getModule('pvpgn')->getServerStatus();
	}

	public function renderContent()
	{
		$data['status'] = $this->getStatus();

		return $this->render('serverStatus',$data);

	}
}