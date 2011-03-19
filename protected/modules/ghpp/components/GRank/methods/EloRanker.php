<?php
/**
 * EloRanker class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * Provides methods for calculating the rating using system Elo
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>, MrJag <agheno@gmail.com>
 * @version $Id:$
 * @package modules.ghpp.components.GRank.methods
 */
class EloRanker extends GBaseRanker {

  /**
   * Calculate score of player using Elo formula
   * @param mixed $unrankedPlayer
   * @param array $teamData
   */
  public function scorePlayer($unrankedPlayer, $teamData)
  {

    $rankedPlayer =& $this->getRankedPlayer($unrankedPlayer->name, $unrankedPlayer->server);

    $currentTeam = $teamData[$unrankedPlayer->team];
    $otherTeam = $teamData[($unrankedPlayer->team ? 0 : 1)];

    //$soloWeight = 0.5; //hardcode to 50% solo  50% team
    //$soloWeight = 0.0; //hardcode to  0% solo 100% team
    //$soloWeight = ($game['playerswin'] - 1) / $game['playerswin']; //dynamic 80% solo 20% team in a 5 player game
    $soloWeight = (1.0 / $currentTeam['players']); //dynamic 20% solo 80% team in a 5 player game
    $teamWeight = (1.0 - $soloWeight);

    $rankedPlayer->id = $unrankedPlayer->id;
		$rankedPlayer->kills += $unrankedPlayer->kills;
		$rankedPlayer->deaths += $unrankedPlayer->deaths;
		$rankedPlayer->assists += $unrankedPlayer->assists;
		$rankedPlayer->creepkills += $unrankedPlayer->creepkills;
		$rankedPlayer->creepdenies += $unrankedPlayer->creepdenies;
		$rankedPlayer->neutralkills += $unrankedPlayer->neutralkills;
		$rankedPlayer->secondsplayed += $unrankedPlayer->secondsplayed;
		$rankedPlayer->wins += $unrankedPlayer->win;
    $rankedPlayer->server = $unrankedPlayer->server;
    $rankedPlayer->name = $unrankedPlayer->name;
		$rankedPlayer->games++;

		// adjust player skill using a 3-tier system
    if ($rankedPlayer->games < 30)
    {
      //$kFactor = 25.0; //hardcoded to 25 points for newbies with less than 30 games
      $kFactor = self::kFactor1;
    }
    elseif ($rankedPlayer->skill < 2400)
    {
      //$kFactor = 15.0; //hardcoded to 15 points for regular players
      $kFactor = self::kFactor2;
    }
    else
    {
      //$kFactor = 10.0; //hardcoded to 10 points for good players
      $kFactor = self::kFactor3;
    }

    //$someConstant = 400; //default value used in Chess FIDE
    //$someConstant = 1572; //i forgot but I think this value sets a 750 point difference to 75% win.
    $someConstant = 800; // this constant seems to best match our expected point spread.

    $expectedTeamScore = 1/(1 + pow( 10,(($otherTeam['skill'] - $currentTeam['skill'])/$someConstant) ) ); // expected win percentage
    $actualTeamScore = $currentTeam['win'];

    $expectedSoloScore = 1/(1 + pow( 10,((($otherTeam['skill']/$otherTeam['players']) - $rankedPlayer->skill)/$someConstant) ) ); // expected win percentage

    $actualSoloScore = 0.5 + ( ($rankedPlayer->contributionpoints < 0) ? -1 : 1 ) * ( $rankedPlayer->contributionpoints / (2 * ( ($rankedPlayer->contributionpoints < 0) ? $currentTeam['lossContribution'] : $currentTeam['winContribution']) ) );

    $rankedPlayer->teamadjustment = $teamWeight * $kFactor * ($actualTeamScore - $expectedTeamScore);
    $rankedPlayer->soloadjustment = $soloWeight * $kFactor * ($actualSoloScore - $expectedSoloScore);


    $rankedPlayer->skill += $rankedPlayer->teamadjustment + $rankedPlayer->soloadjustment;
    
    $this->saveRankedPlayer($rankedPlayer);
  }

  /**
   * Calculate skill per each team
   * @param array $unrankedPlayers objects of players
   * @param int $teamid team to be ranked ( 1 or 0 )
   * @return array team data
   */
  public function scoreTeam($unrankedPlayers, $teamid)
  {
            
    //initialize team array data
    $unrankedTeam = array(
      'name'              => (($teamid == 0) ? "Sentinel" : "Scourge"),
      'skill'             => 0,
      'winContribution'   => 1,
      'lossContribution'  => -1,
      'players'           => 0,
      'win'               => 0,
    );

    Yii::trace("Calculating stats for the " . $unrankedTeam['name'] . " team.", 'Ranker');
    foreach($unrankedPlayers as $index => $unrankedPlayer)
    {
      if ($unrankedPlayer->team == $teamid) //($unrankedPlayer->team === 0) || ($unrankedPlayer->team === 1)
      {

          $rankedPlayer =& $this->getRankedPlayer($unrankedPlayer->name, $unrankedPlayer->server);
          $unrankedTeam['skill']+= $rankedPlayer->skill;
          Yii::trace("Adding [" . $rankedPlayer->skill . "] skill points from [" . $unrankedPlayer->name . "] to team [" . $unrankedPlayer->team . "] for a total of [" . $unrankedTeam['skill'] . "]", "Ranker");
         
          $rankedPlayer->contributionpoints = $this->calcContribution(
            $unrankedPlayer->kills,
            $unrankedPlayer->deaths,
            $unrankedPlayer->assists,
            $unrankedPlayer->creepkills,
            $unrankedPlayer->creepdenies,
            $unrankedPlayer->neutralkills
          );

          var_dump($rankedPlayer->contributionpoints);
          if ($rankedPlayer->contributionpoints < 0) // negative contribution points
          {
            $unrankedTeam['lossContribution'] += $rankedPlayer->contributionpoints;
          }
          else // positive contribution points
          {
            $unrankedTeam['winContribution'] += $rankedPlayer->contributionpoints;
          }

          Yii::trace("Adding [" . $rankedPlayer->contributionpoints . "] contribution points from [" . $unrankedPlayer->name . "] to team [" . $unrankedPlayer->team . "] for a total of [" . $rankedPlayer->contributionpoints . "]", "Ranker");

          $unrankedTeam['players']++;

          $unrankedTeam['win'] = $unrankedPlayer->win;

      }
    }
    return $unrankedTeam;
  }

}