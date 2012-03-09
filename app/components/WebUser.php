<?php


/**
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */
class WebUser extends CWebUser {

    /**
     * Alias to {@link setFlash} with success key
     * @param $value
     * @param null $defaultValue
     */
    public function success($value,$defaultValue=null)
    {
        return $this->setFlash('success',$value,$defaultValue);
    }

    /**
     * Alias to {@link setFlash} with info key
     * @param $value
     * @param null $defaultValue
     */
    public function info($value, $defaultValue = null)
    {
        return $this->setFlash('info',$value,$defaultValue);
    }

    /**
     * Alias to {@link setFlash} with warning key
     * @param $value
     * @param null $defaultValue
     */
    public function warning($value, $defaultValue = null)
    {
        return $this->setFlash('warning',$value,$defaultValue);
    }

    /**
     * Alias to {@link setFlash} with error key
     * @param $value
     * @param null $defaultValue
     */
    public function error($value, $defaultValue = null)
    {
        return $this->setFlash('error',$value,$defaultValue);
    }

    /**
     * Magic method, retrieve
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($this->hasState('__userInfo')) {
            $user=$this->getState('__userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }

        return parent::__get($name);
    }

    public function login($identity, $duration=0)
    {
        $this->setState('__userInfo', $identity->getUser());
        parent::login($identity, $duration);
    }
}
