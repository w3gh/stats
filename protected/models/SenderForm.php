<?php

/**
 * SenderForm class.
 * SenderForm is the data structure for keeping
 * contact form data. It is used by the 'Sender' action of 'SiteController'.
 */
class SenderForm extends CFormModel
{
  public $server;
  public $port;
  public $message;

  /**
   * Declares the validation rules.
   */
  public function rules()
  {
    return array(
      // name, email, subject and body are required
      array('message','required'),
      // verifyCode needs to be entered correctly
      array('port', 'numerical'),
    );
  }

  /**
   * Declares customized attribute labels.
   * If not declared here, an attribute would have a label that is
   * the same as its name with the first letter in upper case.
   */
  public function attributeLabels()
  {
    return array(
      'server'=>'Server to Send',
      'port'=>'Port to Send',
      'message'=>'Message to Send',
    );
  }
}