<?php

/**
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */
class PhpAuthManager extends CPhpAuthManager {

    public function init(){

        if($this->authFile===null){
            $this->authFile=Yii::getPathOfAlias('application.config.roles').'.php';
        }

        parent::init();

        // For guests we have default role
        if(!app()->user->isGuest){
            $this->assign(app()->user->role,app()->user->id);
        }
    }
}
