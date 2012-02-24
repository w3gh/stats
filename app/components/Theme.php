<?php

/**
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */
class Theme extends CTheme
{

    private $_assetsUrl;

    /**
     * the base URL that contains all published asset files of current active theme.
     * @return string
     */
    public function getAssetsUrl()
    {

        if($this->_assetsUrl!==null){
            return $this->_assetsUrl;
        }
        else{
            $assetsPath=$this->basePath.DIRECTORY_SEPARATOR.'assets';
            $this->setAssetsUrl($assetsPath);
            return $this->_assetsUrl;
        }
    }

    /**
     * the base URL that contains all published asset files of current active theme.
     * @param $path string
     */
    public function setAssetsUrl($path)
    {
        if(($assetsPath=realpath($path))===false || !is_dir($assetsPath) || !is_writable($assetsPath))
            throw new CException(__('app','Assets path "{path}" is not valid. Please make sure it is a directory writable by the Web server process.',
                array('{path}'=>$path)));

        $assetsUrl = app()->assetManager->publish($path,false,-1,YII_DEBUG);

        $this->_assetsUrl=$assetsUrl.'/';
    }
}