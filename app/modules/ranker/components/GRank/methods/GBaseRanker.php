<?php
/**
 * GBaseRanker class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * Provides methods used in ranking systems
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>, MrJag <agheno@gmail.com>
 * @version $Id:$
 * @package modules.ghpp.components.GRank.methods
 */
abstract class GBaseRanker {

    const kFactor1 = 36;
    const kFactor2 = 24;
    const kFactor3 = 16;

    public $xpModifier     = 1.0;
    public $goldModifier   = 1.0;
    public $avgXPKill      = 1716.667;
    public $avgGoldKill    = 640.0;
    public $avgXPDeath     = 2203.0;
    public $avgGoldDeath   = 640.0;
    public $avgXPAssist    = 858.333;
    public $avgGoldAssist  = 0.0;
    public $avgXPCreep     = 58.202;
    public $avgGoldCreep   = 29.152;
    public $avgXPNeutral   = 70.0;
    public $avgGoldNeutral = 40.0;

    public static $rankedPlayers;

    private $_rank;

    abstract function scorePlayer($unrankedPlayer, $unrankedTeams);

    abstract function scoreTeam($unrankedPlayers, $team);

    public function  __construct($rankObject) {
        $this->_rank=$rankObject;
    }

    /**
     * Saves player using GRank class
     * @param mixed $player
     */
    public function saveRankedPlayer($player)
    {
        $this->_rank->saveRankedPlayer($player);
    }

    /**
     *
     * @param string $playerName
     * @param string $server
     * @return mixed Player data
     */
    public function &getRankedPlayer($playerName, $server)
    {
        if(!isset(self::$rankedPlayers[$playerName]))
        {
            if($player = $this->_rank->getRankedPlayer($playerName, $server))
                self::$rankedPlayers[$server][$playerName]=$player;
            else
                self::$rankedPlayers[$server][$playerName]=new CAttributeCollection(array('isnew'=>true, 'name'=> $playerName, 'server'=>$server, 'skill' => 1000, 'id' => 0, 'games' => 0, 'kills' => 0, 'deaths' => 0, 'assists' => 0, 'creepkills' => 0, 'creepdenies' => 0, 'neutralkills' => 0, 'wins' => 0, 'contributionpoints' => 0, 'contributionpercent'=>0, 'teamadjustment'=>0, 'soloadjustment'=>0, 'rd'=>0, 'secondsplayed'=>0));
        }
        return self::$rankedPlayers[$server][$playerName];
    }

    /*
    * Calculate contribution points
    */
    public function calcContribution($kills, $deaths, $assists, $creeps, $denies, $neutrals)
    {

        $result = (
            $kills		* (($this->avgXPKill * $this->xpModifier) + ($this->avgGoldKill * $this->goldModifier))
                - $deaths		* (($this->avgXPDeath * $this->xpModifier) + ($this->avgGoldDeath * $this->goldModifier))
                + $assists	* (($this->avgXPAssist * $this->xpModifier) + ($this->avgGoldAssist * $this->goldModifier))
                + $creeps		* (($this->avgXPCreep * $this->xpModifier) + ($this->avgGoldCreep * $this->goldModifier))
                + $denies		* ((0.5 * $this->avgXPCreep * $this->xpModifier) + (0.5 * $this->avgGoldCreep * $this->goldModifier))
                + $neutrals	* (($this->avgXPNeutral * $this->xpModifier) + ($this->avgGoldNeutral * $this->goldModifier))
        );

        return $result;
    }

}
?>
