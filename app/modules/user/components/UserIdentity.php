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
     * Server from user
     * @var string
     */
    public $server;

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
        $user = User::model()->find(
            array('username=:username','server=:server'),
            array(':username'=>$this->username,':server'=>$this->server));

		if($user->username!==$this->username)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
		else if($user->password!==$user->hash($this->password))
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
		else
        {
            $this->_id=strtolower($this->username);
            $this->setState('role',$user->role);
            $this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }

}