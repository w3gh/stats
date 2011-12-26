<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $users = include Yii::getPathOfAlias('application.config.users').'.php';

		if(!isset($users[$this->username]))
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
		else if($users[$this->username]['password']!==$this->hash($users[$this->username]['salt']))
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
		else
        {
            $this->_id=strtolower($this->username);
            $this->setState('role',$users[$this->username]['role']);
            $this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }

    protected function hash($salt)
    {
        return md5($this->password.$salt);
    }
}