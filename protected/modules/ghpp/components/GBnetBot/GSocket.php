<?php


/**
 *
 * @author Nicholas Kostyurin
 */
abstract class GSocket extends CComponent
{
  /**
   * Minimum buffer size for the TCP
   * @var int
   */
  public $buffersize=256;

  /**
   * Socket type
   */
  const Type=SOCK_STREAM;

  public $timeout_sec=0;
  public $timeout_msec=0;

  public $packets='';

	private $_socket;
  private $_active=false;

  private $buffer_size = 256;
  private $write_buffer;
  private $write_len = 0;
  public $read_buffer;

  private $remote_address;
  private $remote_port;
  private $local_addr;
  private $local_port;



  private $_errorno;
  private $_errorstr;

  /**
   * Constructor
   * @param $server string host name or IP
   * @param $port int host port
   */
	public function __construct($server=null,$port=0)
	{
		$this->remote_address=strval(gethostbyname(trim($server)));
		$this->remote_port=intval(max(0, $port));
	}


  public function connect()
  {
   $this->open();
   $this->init();
  }

  public function init()
  {
  }

  public function disconnect()
  {
   $this->close();
  }

	/**
	 *
	 * @return boolean status of socket
	 */
	protected function open()
	{
		if($this->_socket===null)
		{
			if(empty($this->remote_address)&&empty($this->remote_port))
			 throw new GSocketException(Yii::t("yii",'GSocket.remote_address or GSocket.remote_port cannot be empty'));
			try
			{
				Yii::trace('Open Socket connection');
        $this->initConnection($this->_socket);
        $this->_active=true;
			}
			catch(Exception $e)
			{
        throw new GSocketException(Yii::t('yii','GSocket failed to open the connection: {error}',
          array('{error}'=>$e->getMessage())));
			}

		}
	}


	/**
	 * Close the currently active socket
	 */
	protected function close()
	{
		Yii::trace('Closing Socket connection');
    socket_close($this->_socket);
    $this->_active=false;
	}


	 /**
   * Initializes the open socket connection.
   * This method is invoked right after the socket connection is established.
   * @param Socket the Socket instance
   */
	protected function initConnection($socket)
	{

		$timeout['sec'] = 0;
    $timeout['usec'] = 0;

    if(isset($this->_socket))
    {
      socket_close($this->_socket);
      unset($this->_socket);
    }
    try
    {
    if(($this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false )
      throw new GSocketException("Could not create socket: ".$this->getError());

    if (!socket_set_option($this->_socket, SOL_SOCKET, SO_REUSEADDR, 1))
      throw new GSocketException(Yii::t("yii","Could not set SO_REUSEADDR: {error}", array("{error}"=>$this->getError())));

    if(!socket_connect($this->_socket, $this->remote_address, $this->remote_port))
      throw new GSocketException(Yii::t("yii","Could not connect to {addres}:{port} - {error}",
            array("{addres}"=>$this->remote_address, "{port}"=>$this->remote_port, "{error}"=>$this->getError())));

    if (!socket_getsockname($this->_socket, $this->local_addr, $this->local_port))
      throw new GSocketException("Could not retrieve local address & port: ".$this->getError());

    if (!socket_set_nonblock($this->_socket))
      throw new GSocketException("Could not set socket to non-blocking: ".$this->getError());

    if (!socket_set_option($this->_socket, SOL_SOCKET, SO_RCVTIMEO, $timeout ))
      throw new clientException("Could net set recieve timeout: ".$this->getError());

    if (!socket_set_option($this->_socket, SOL_SOCKET, SO_SNDTIMEO, $timeout ))
      throw new clientException("Could net set send timeout: ".$this->getError());

    	//$this->_socket=fsockopen($this->server,$this->port,$this->_errorno,$this->_errorstr,$this->timeout);
    }
    catch(GSocketException $e)
    {
    	throw new GSocketException(Yii::t("yii","Could not connect to {server} {port} - {error}",
    	 array('{server}'=>$this->server,'{port}'=>$this->port,'{error}'=>$this->getMessage())));
    }
	}

  /**
   * Push data to socket
   * @param $data string
   */
  public function push($data='')
  {
    $this->write_buffer .= $data;
    $buffer_len = strlen($this->write_buffer);
    $byte_written = socket_write($this->_socket, $this->write_buffer, $buffer_len);

    if ($byte_written === false)
    {
      $this->_active = false;
      $this->onDisconnect(new CEvent($this));
    }

    if($byte_written < $buffer_len)
    {
      $this->write_buffer = substr($this->write_buffer, $byte_written);
      $this->write_len = $buffer_len - $byte_written;
    }
    else
    {
      $this->write_buffer = '';
      $this->write_len = 0;
    }
  }

  /**
   * Pull data from socket
   */
  public function pull($bsize=false)
  {
    $buffer = socket_read($this->_socket, $bsize or $this->buffer_size, PHP_BINARY_READ);

    //no packet means connection closed / failed / disconnected
    if(!$buffer)
    {
      $this->_active = false;
      $this->onDisconnect(new CEvent($this));
    }

    $buffer = $this->read_buffer .= $buffer ? $buffer : '';
    $buffer_len = strlen($buffer);
    $packets = '';

    //packet must start with a valid header
    if($buffer_len > 0 && $buffer[0] != "\xff" && $buffer[0] != '')
      throw new CException("Invalid packet header. Suppose to be 0xff");

    //to form a complete packet
    //minimum packet len must be at least 4 byte.
    //if the buffer doesn't reach 4 byte yet return false
    if($buffer_len > 3)
    {
      $packet_len = ord($buffer[2]) + (ord($buffer[3]) << 8);

      //check for completeness of packet again, return false if not complete
      if($buffer_len >= $packet_len)
      {
        do
        {
          //fetch buffer unitl specified offset
          for($i=0, $temp=''; $i < $packet_len; $i++)
          {
            $temp .= $buffer[$i];
          }

          //not suppose to happen
          if($temp[0] != "\xff")
          {
            //echo "Discarding unexpected packets...\n";
            $temp = '';
            throw new CException("Invalid packet header. Suppose to be 0xff");
          }

          //stack the packets
          $this->packets .= $temp;

          //get remaining buffer
          for($temp=''; $i < $buffer_len; $i++)
          {
            $temp .= $buffer[$i];
          }

          //assign remaining buffer to buffer variable
          $buffer = $temp;
          //recalculate buffer lenght
          $buffer_len = strlen($buffer);
          //reset packet lenght
          $packet_len = 0;
          //clear temporarily variable
          $temp = '';

          //buffer len > 3
          if($buffer_len > 3)
          //calculate next packet ending offset
          $packet_len = ord($buffer[2]) + (ord($buffer[3]) << 8);

        //if next packet lenght is more than 0 and still have remaining buffer is complete to reach next process, repeats loop
        }while($packet_len > 0 && $buffer_len >= $packet_len);

        //store incomplete packet into buffer
        $this->read_buffer = $buffer;
        //handle the event
        $this->onRecieve(new CEvent($this));
      }
    }
  }

	/**
	 * Write data to socket
	 *
	 * @param $data string data to write
	 */
	public function write($data)
	{
    if($this->getActive()&&$result=fwrite($this->_socket, $data))
    {
    	return true;
    }
    return $this->_active=false;
	}

	/**
	 * Read data from socket
	 *
	 * @param $length int a length data to read from
	 */
	public function read($length=false)
	{
		$length= $length ? $length : $this->buffersize;
    if($this->getActive()&&$input=fread($this->_socket, $length))
    {
      return trim($input);
    }
    return $this->_active=false;
	}

	/**
	 * Return last socket error
	 */
	public function getError()
	{
		$error_no = socket_last_error($this->_socket);
    $error = 'error no: ' . $error_no . ', ' . socket_strerror($error_no);
    socket_clear_error($this->_socket);
    return $error;
	}
  /**
   * @return boolean whether the DB connection is established
   */
  public function getActive()
  {
    return $this->_active;
  }

  /**
   * Open or close the DB connection.
   * @param boolean whether to open or close DB connection
   * @throws CException if connection fails
   */
  public function setActive($value)
  {
    if($value!=$this->_active)
    {
      if($value)
        $this->open();
      else
        $this->close();
    }
  }


  public function onConnect($event)
  {
    $this->raiseEvent('onConnect',$event);
  }

  public function onRecieve($event)
  {
  	$this->raiseEvent('onRecieve',$event);
  }

  public function onDisconnect($event)
  {
    $this->raiseEvent('onDisconnect',$event);
  }
}
