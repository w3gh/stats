<?php

/*
 * MenuTop class file
 *
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 * @link http://artkost.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kostyurin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

Yii::import('zii.widgets.CMenu');

class MenuTop extends CMenu
{

  public function __construct($owner = null)
  {
    parent::__construct($owner);
    $this->id='menu-top';
    $this->items = $this->getItems();
  }

  public function getItems()
  {
    return array(
      array('label' => Yii::t('menuTop', 'Home'), 'url' => array('/post/index')),
      array('label' => Yii::t('menuTop', 'About'), 'url' => array('/site/page', 'view' => 'about')),
      array('label' => Yii::t('menuTop', 'For Bot'), 'url' => array('/site/sender')),
      array('label' => Yii::t('menuTop', 'Login'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
      array('label' => Yii::t('menuTop', 'Logout') . '(' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
    );
  }

}
