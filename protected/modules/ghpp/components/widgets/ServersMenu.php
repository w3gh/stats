<?php

Yii::import('zii.widgets.CMenu');

class ServersMenu extends CMenu
{

  public function  __construct($owner = null)
  {
    parent::__construct($owner);
    $this->items=$this->prepareServers();
  }

  public function getServers()
  {
    return Servers::model()->findAll();
  }

  public function prepareServers()
  {
    $servers = $this->getServers();
    $serversMenu = array(
      array('label' => Yii::t('ghppModule.players', 'All'), 'url' => array('index')),
    );
    foreach ($servers as $id => $server)
    {
      //array('label'=>Yii::t('menuTop', 'Home'), 'url'=>array('/post/index')),
      $serversMenu[] = array('label' => $server->name, 'url' => array('index', 'server' => $server->id));
    }

    return $serversMenu;
  }

}
