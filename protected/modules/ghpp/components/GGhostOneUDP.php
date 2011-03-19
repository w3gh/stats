<?php


/**
 *
 * @author Nicholas Kostyurin
 */
class GGhostOneUDP extends GUDP
{

	const SEND_PORT=6969;
  const PORTNO=5959;

  private $_password='';
  private $_ip;
  private $_messages_in;


  /**
   *
   */
  public function __construct($server=null,$port=0,$password)
  {
  	parent::__construct($server,$port);

  	$this->_messages_in=array(
  	 '|startgame',
  	 '|loadedgame',
  	 '|endgame',
  	 '|game',
  	 '|pong',
  	 '|gameupdate'
  	);

  	$this->_ip="192.168.1.33";
  	$this->_password=$password;

  	$this->send(sprintf('connect %s',$this->_password));
  }

  public function send($data)
  {
    $cmd=sprintf('||%s %s',$this->_ip,$data);
    self::write($cmd);
  }
}

?>