<?php

/**
 * GRanker class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * Component for Ranking DotA Players using avaible rank methods
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @version $Id:$
 * @package modules.ghpp.components
 */
class GRanker extends CApplicationComponent {

  private $_id;
  private $_rank;
  private $_criteria;

  /**
   * Used if {@link $model} is not defined.
   * @var string model class name
   */
  public $modelClass;

  /**
   * Model used in ranking, provides players list and etc
   * @var CModel
   */
  public $model;

  /**
   * Method used for ranking (Default 'Elo')
   * @var string
   */
  public $rankMethod;

  /**
   * Main method for ranking system
   * @param int $processCap
   */
  public function run($processCap=0) {
    //check last ranked game id, if null, we not rank any games
    $lastRankedGameID = Yii::app()->var->get('lastRankedGameID');
    $lastRankedGameID = $lastRankedGameID == null ? 0 : $lastRankedGameID;
    Yii::trace("lastRankedGameID = " . $lastRankedGameID, "Ranker");

    //find games start from last ranked game id
    $criteria = new CDbCriteria();
    $criteria->condition = 'g.id > :gameid';
    $criteria->params = array(':gameid' => $lastRankedGameID);

    $unrankedGames = Games::model()->unrankedGames()->findAll($criteria);

    //rank all unranked games
    $processedGames = 0;
    while ($unrankedGame = array_shift($unrankedGames)) {
      $processedGames++;
      if (($processedGames < $processCap) or !($processCap)) {
        Yii::app()->var->set('lastRankedGameID', $unrankedGame['id']);
        if ($this->rankGame($unrankedGame['id']) == false);
          continue;
      }
      else {
        break;
      }
    }
  }

  /**
   * Rank game using defined {@link $rankMethod}
   * @param int $gameid # of game for ranking
   */
  protected function rankGame($gameid) {
    $unrankedPlayers = $this->model->unrankedPlayers()->findAll(array(
        'condition' => 'g.id = :gameid', 'params' => array(':gameid' => $gameid)
      ));

    Yii::trace("Calculating stats for game " . $gameid . ".", "Ranker");

    $unrankedTeams = $rankedTeams = array(
      '0' => array(
        'name' => "Sentinel",
        'skill' => 0,
        'contribution' => 0,
        'players' => 0,
        'win' => 0,
      ),
      '1' => array(
        'name' => "Scourge",
        'skill' => 0,
        'contribution' => 0,
        'players' => 0,
        'win' => 0,
      ),
    );

    $transaction = Yii::app()->getDb()->beginTransaction();
    try {
      //first we score summary points per team
      foreach ($unrankedTeams as $teamid => $team) {
        $rankedTeams[$teamid] = $this->getRanker()->scoreTeam($unrankedPlayers, $teamid); // Process the team data
        if ($rankedTeams[$teamid]['players'] == 0) {
          $transaction->rollback();
          return FALSE;
        }
      }

      //second we score individual points for player
      foreach ($unrankedPlayers as $unrankedPlayer) {
        $this->getRanker()->scorePlayer($unrankedPlayer, $rankedTeams); // Process the player data
      }
      $transaction->commit();
      return TRUE;
    } catch (CException $e) {
      $transaction->rollback();
      //throw new CException(Yii::t(''));
    }
  }

  /**
   * Saves player data into database using Scores and Rankplayers models
   * @param mixed $player object of player
   */
  public function saveRankedPlayer($player) {
    $score = new Scores();
    $rankplayer = new Rankplayers();
    $category = "dota_" . strtolower($this->rankMethod);

    $score->isNewRecord = $rankplayer->isNewRecord = isset($player->isnew);
    /*
      'name' => string 'ld.' (length=3)
      'server' => string '89.105.144.41' (length=13)
      'skill' => float 1015.5400928348
      'id' => string '306667' (length=6)
      'games' => int 1
      'kills' => int 8
      'deaths' => int 1
      'assists' => int 2
      'creepkills' => int 76
      'creepdenies' => int 4
      'neutralkills' => int 41
      'wins' => int 1
      'contributionpoints' => float 29050.614
      'contributionpercent' => int 0
      'teamadjustment' => float 14.4
      'soloadjustment' => float 1.1400928348228
      'rd' => int 0
      'secondsplayed' => int 1751
     */

    $score->score = $player->skill;
    $rankplayer->name = $score->name = $player->name;
    $rankplayer->category = $score->category = $category;
    $rankplayer->server = $score->server = $player->server;
    $rankplayer->games = $player->games;
    $rankplayer->wins = $player->wins;
    $rankplayer->kills = $player->kills;
    $rankplayer->deaths = $player->deaths;
    $rankplayer->assists = $player->assists;
    $rankplayer->creepkills = $player->creepkills;
    $rankplayer->creepdenies = $player->creepdenies;
    $rankplayer->neutralkills = $player->neutralkills;
    $rankplayer->secondsplayed = $player->secondsplayed;
    $rankplayer->contributionpoints = $player->contributionpoints;
    $rankplayer->contributionpercent = $player->contributionpercent;
    $rankplayer->teamadjustment = $player->teamadjustment;
    $rankplayer->soloadjustment = $player->soloadjustment;
    $rankplayer->rd = $player->rd;

    $score->save();
    $rankplayer->save();
  }

  /**
   * Get ranked player from rankplayers table
   * @param string $playerName
   * @return CMap array of elements
   */
  public function getRankedPlayer($playerName, $server) {
    $criteria = new CDbCriteria();
    $criteria->condition = 'rp.name = :name AND rp.server = :server';
    $criteria->params = array(':name' => $playerName, ':server' => $server);
    $criteria->limit = 1;

    $data = Rankplayers::model()->scores()->findAll($criteria);

    return array_shift($data);
  }

  /**
   * Initiate Application component
   */
  public function init() {
    if (!empty($this->modelClass)) {
      //$this->modelClass=$modelClass;
      $this->model = CActiveRecord::model($this->modelClass);
    } else if ($this->modelClass instanceof CActiveRecord) {
      $this->model = $this->modelClass;
      $this->modelClass = get_class($this->modelClass);
    }
    $this->setId($this->modelClass);
//		foreach($config as $key=>$value)
//			$this->$key=$value;
  }

  /**
   * @return string the unique ID.
   */
  public function getId() {
    return $this->_id;
  }

  /**
   * @param string the unique ID.
   */
  public function setId($value) {
    $this->_id = $value;
  }

  /**
   * @return CDbCriteria the query criteria
   */
  public function getCriteria() {
    if ($this->_criteria === null)
      $this->_criteria = new CDbCriteria;
    return $this->_criteria;
  }

  /**
   * @param mixed the query criteria. This can be either a CDbCriteria object or an array
   * representing the query criteria.
   */
  public function setCriteria($value) {
    $this->_criteria = $value instanceof CDbCriteria ? $value : new CDbCriteria($value);
  }

  /**
   * @return CBaseRanker the ranker object.
   */
  public function getRanker() {
    if ($this->_rank === null) {
      if ($this->rankMethod === null)
        $method = 'Elo';
      else
        $method = $this->rankMethod;
      $rankerClass = $method . 'Ranker';

      if (!class_exists($rankerClass))
        $rankerClass = 'EloRanker';

      $this->_rank = new $rankerClass($this);
    }
    return $this->_rank;
  }

  /**
   * @param mixed the ranker to be used by this GRank. This could be a {@link GBaseRanker} object
   * or an array used to configure the ranker object.
   */
  public function setRanker($value) {
    if (is_array($value)) {
      $ranker = $this->getRanker();
      foreach ($value as $k => $v)
        $ranker->$k = $v;
    }
    else
      $this->_ranker = $value;
  }

}

?>
