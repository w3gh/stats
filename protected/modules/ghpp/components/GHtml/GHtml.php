<?php

/**
 * GHtml class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * 
 *
 * @author Kosturin Nikolay <jilizart@gmail.com>
 * @copyright 2010, Kosturin Nikolay
 * @license Apache 2.0
 * @package application.modules.ghpp.components.GHtml
 * 
 */

/**
 * 
 */
class GHtml extends CHtml
{

  /**
   * Detects and formating player status
   * @param mixed $data object or array data from player
   * @return string formated span element with right status class
   */
  public static function playerStatus($data, $htmlOptions=array('class'=>''))
  {
    $htmlOptions['class'].=' normal';
    
    if($data->isadmin) $htmlOptions['class']=' admin';
    if($data->isbanned) $htmlOptions['class']=' banned';

    $span=self::tag('span', array('class'=>'icon'), '&nbsp;');
    return self::tag('span', $htmlOptions, $span.$data->name);
  }

  /**
   * Convert full map path to normal Map name
   * @param mixed $data data from game
   * @return string Map Name
   */
  public static function normalizeMapName($data)
  {
    $map=is_object($data) ? $data->map : $data; // maps\download\DotA Allstars v6.65.w3x
    $mapElems = explode("\\", $map); // array of all path elements ( maps, download, DotA Allstars v6.65.w3x )
    $mapFile = array_pop($mapElems); // get DotA Allstars v6.65.w3x
    return $mapName = str_replace('.w3x', '', $mapFile); // replace DotA Allstars v6.65.w3x to DotA Allstars v6.65
  }

  /**
   * Determine game type ( public or private )
   * @param mixed $data data from game
   * @return string
   */
  public static function gameType($data)
  {
    $type=is_object($data) ? $data->gamestate : $data;
    switch ($type) {
      case '16':
        return "public";
        break;
      case '17':
        return "private";
        break;
    }

  }

    /**
   * Determine game winner ( scourge or sentinel )
   * @param mixed $data data from game
   * @return string
   */
  public static function gameWinner($data)
  {
    $type=is_object($data) ? $data->winner : $data;
    switch ($type) {
      case '0':
        return "draw";
        break;
      case '1':
        return "sentinel";
        break;
      case '2':
        return "scourge";
        break;
    }

  }

  /**
   * Convert seconds to normal time format
   * @param int $seconds count of seconds
   * @return string the time like 1:43:32
   */
  public static function secondsToTime($seconds)
  {
    $hours = floor($seconds/3600);
    $secondsRemaining = $seconds % 3600;

    $minutes = floor($secondsRemaining/60);
    $seconds_left = $secondsRemaining % 60;

    if($hours != 0)
    {
      if(strlen($minutes) == 1)
      {
      $minutes = "0".$minutes;
      }
      if(strlen($seconds_left) == 1)
      {
      $seconds_left = "0".$seconds_left;
      }
      return $hours.":".$minutes.":".$seconds_left;
    }
    else
    {
      if(strlen($seconds_left) == 1)
      {
      $seconds_left = "0".$seconds_left;
      }
      return "00:".$minutes.":".$seconds_left;
    }
  }

  /**
   * Convert player db colour value into css color class
   * @param int $number player newcolour value
   * @return string css class of color
   */
  public static function getColor($number)
  {
    switch ($number) {
      case 1: return 'red';
        case 2: return 'blue';
          case 3: return 'purple';
            case 4: return 'yellow';
              case 5: return 'orange';
                case 6: return 'red';
                  case 7: return 'red';
                    case 8: return 'red';
                      case 9: return 'red';
                        case 10: return 'red';
                          case 11: return 'red';
                            case 12: return 'red';

    }
  }

}
