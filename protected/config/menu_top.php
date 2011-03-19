<?php

return array(

  array('label'=>Yii::t('menuTop', 'Home'), 'url'=>array('/post/index')),
  array('label'=>Yii::t('menuTop', 'About'), 'url'=>array('/site/page', 'view'=>'about')),
  array('label'=>Yii::t('menuTop', 'For Bot'), 'url'=>array('/site/sender')),
  array('label'=>Yii::t('menuTop', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
  array('label'=>Yii::t('menuTop', 'Logout').'('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)

);

?>
