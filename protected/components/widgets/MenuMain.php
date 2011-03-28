<?php

/*
 * MenuMain class file
 *
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 * @link http://artkost.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kostyurin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

Yii::import('zii.widgets.CMenu');

class MenuMain extends CMenu
{

  public function __construct($owner = null)
  {
    parent::__construct($owner);
    $this->id='menu-main';
    $this->items = $this->getItems();
  }

  public function getItems()
  {
    return array(
      array('label' => Yii::t('menu', 'Admins'), 'url' => array('/ghpp/admins/index')),
      array('label' => Yii::t('menu', 'Bans'), 'url' => array('/ghpp/bans/index')),
      array('label' => Yii::t('menu', 'Players'), 'url' => array('/ghpp/players/index')),
      array('label' => Yii::t('menu', 'Games'), 'url' => array('/ghpp/games/index')),
      array('label' => Yii::t('menu', 'Servers'), 'url' => array('/ghpp/servers/index')),
    );
  }

}