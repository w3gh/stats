<?php



/**
 *
 * @author Nicholas Kostyurin
 */
class GBnetProtocol extends GTCP
{

	const USERNAME_MIN_LEN = 3;
  const USERNAME_MAX_LEN = 15;
  const PROTOCOL_ID = "\x01";
  const SID_AUTH_INFO = "\x50";
  const SID_CHATEVENT = "\x0F";
  const SID_PING = "\x25";
  const SID_AUTH_CHECK = "\x51";
  const SID_AUTH_ACCOUNTLOGON = "\x53";
  const SID_AUTH_ACCOUNTLOGONPROOF = "\x54";
  const SID_NETGAMEPORT = "\x45";
  const SID_ENTERCHAT = "\x0A";
  const SID_GETICONDATA = "\x2D";
  const SID_JOINCHANNEL = "\x0C";
  const SID_CHATCOMMAND = "\x0E";

  const CHAT_USER_FLAG = 12;
  const CHAT_SHOWUSER = "\x01";
  const CHAT_JOIN = "\x02";
  const CHAT_LEAVE = "\x03";
  const CHAT_WHISPER = "\x04";
  const CHAT_TALK = "\x05";
  const CHAT_BROADCAST = "\x06";
  const CHAT_CHANNEL = "\x07";
  const CHAT_USERFLAGS = "\x09";
  const CHAT_WHISPERSENT = "\x0A";
  const CHAT_CHANNELFULL = "\x0D";
  const CHAT_CHANNELDOESNOTEXIST = "\x0E";
  const CHAT_CHANNELRESTRICTED = "\x0F";
  const CHAT_INFO = "\x12";
  const CHAT_ERROR = "\x13";
  const CHAT_EMOTE = "\x17";

	public $timeout=2;

	public $buffersize=4096;

	public $lastwhispername='';

	private $_username='';
	private $_password='';


	public function __construct($server,$username,$password,$port=6112)
	{
	 parent::__construct($server,$username);
	 $this->_username=$username;
	 $this->_password=$password;
	}

	public function init()
	{

	}


	public function waitFor($data)
	{
    do
    {
        $buffer = $this->pull();
    } while (!strstr($buffer,$data));
	}



  public function onRecieve($event)
  {
  	$packets=$event->sender->packets;
    while(strlen($packets)!=0)
    {
      //get the following packet length
      $packet_len = ord($packets[2]) + (ord($packets[3]) << 8);
      //fetch the following event packet until the specified offset
      for($i=0, $event = ''; $i < $packet_len; $i++) $event .= $packets[$i];

      //fetch remaing events
      for($temp = '', $data_len = strlen($packets); $i < $data_len; $i++) $temp .= $packets[$i];
      //assign it to data
      $packets = $temp;

      //get event type
      $event_type = $event[1];

      switch($event_type)
      {
        //ping pong \(^.^)/
        case self::SID_PING:
          $this->push($event);
        break;

        //chat event
        case self::SID_CHATEVENT:
          $this->processChat($event);
        break;

        case self::SID_AUTH_INFO:
          $this->sendAuthCheck();
        break;

        case self::SID_AUTH_CHECK:
          $this->sendAuthAccountLogon();
        break;

        case self::SID_AUTH_ACCOUNTLOGON:
          $this->sendAuthLogonProof();
        break;

        case self::SID_AUTH_ACCOUNTLOGONPROOF:
          $this->sendNetGamePort();
          $this->sendEnterChat();
        break;

        case self::SID_ENTERCHAT:
          $this->sendGetIconData();
          $this->joinChannel($this->default_channel);
        break;

        default:
        //ignore other events
      }
    }
  }

  private function processChat($event)
  {
    switch($event[4])
    {
      case self::CHAT_TALK:
        $this->onTalk($event);
      break;

      case self::CHAT_WHISPER:
        $this->onWhisper($event);
      break;

      case self::CHAT_INFO:
        $this->onInform($event);
      break;
    }
  }

  protected function sendGetIconData()
  {
    $this->push("\xFF\x2D\x04\x00");
  }

  protected function sendEnterChat()
  {
    $this->push("\xFF\x0A\x06\x00\x00\x00");
  }

  protected function sendNetGamePort()
  {
    $preoutput = toEndian(INT2WORD($this->gameport));
    $header  = $this->buildHeader(self::SID_NETGAMEPORT, $preoutput);
    $output = $header . $preoutput;
    $this->push($output);
  }

  protected function sendAuthLogonProof()
  {
  //change your passhash accordingly
    $passhash = "\xa1\x17\xf3\x18\xcd\xf6\xe9\xf6\x6f\x7e\x38\xb5\xba\x8f\xf9\x5f\x8a\x49\xc1\x31";
    $header = $this->buildHeader(self::SID_AUTH_ACCOUNTLOGONPROOF, $passhash);
    $output = $header . $passhash;
    $this->push($output);
  }

  protected function sendAuthAccountLogon()
  {
    $logonchallenge = "\x45\x07\xed\x8a\x10\xf3\x73\xe9\xfc\xd5\xb5\xc6\x7d\xd5\xc8\xab\xfb\x08\x79\x64\x2a\xca\x16\x20\x65\x49\x16\x4f\xdc\xeb\x78\x3e";
    $preoutput = $logonchallenge . $this->username . "\x00";//32byte Client Key ('A') + username
    $header = $this->buildHeader(self::SID_AUTH_ACCOUNTLOGON,$preoutput);
    $output = $header . $preoutput;
    $this->push($output);
  }

  protected function sendAuthCheck()
  {
    //SID_AUTH_CHECK 0x51
    $preoutput = "\x00\x00\x00\x00" //Client Token
                ."\x77\x00\x15\x01" //EXE Version
                ."\x02\xEF\xCD\xAB" //EXE Hash
                ."\x02\x00\x00\x00" //Number of keys in this packet
                ."\x00\x00\x00\x00" //Using Spawn (32-bit)? true for yes false for no
                ."\x00\x00\x00\x00" //empty cdkey set 1
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00" //empty cdkey set 2
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."\x00\x00\x00\x00"
                ."war3.exe 10/21/09 17:14:24 471040\x00" //Exe Infomation
                ."BlueGameBot\x00";                       //CDkey owner
        $header = $this->buildHeader(self::SID_AUTH_CHECK,$preoutput);
        $output = $header . $preoutput;
        $this->push($output);
  }

  protected function sendAuthInfo()
  {
    //prepare handshake data
    $preoutput = "\x00\x00\x00\x00"   //protocol id
              ."\x36\x38\x58\x49"   //platform id "68XI"
              ."\x50\x58\x33\x57"   //product id  "PX3W"
              ."\x18\x00\x00\x00"   //version byte
              ."\x53\x55\x6E\x65"   //product language
              ."\x00\x00\x00\x00"   //Local IP for NAT compatibility
              ."\x00\x00\x00\x00"   //Time zone bias
              ."\x00\x00\x00\x00"   //Locale ID
              ."\x00\x00\x00\x00"   //Language ID
              ."USA\x00"            //Country abreviation, String
              ."United States\x00"; //Country, String

    $header  = $this->buildHeader(self::SID_AUTH_INFO,$preoutput);
    $output = $header . $preoutput;
    $this->push(self::PROTOCOL_ID);
    $this->push($output);
  }
}
