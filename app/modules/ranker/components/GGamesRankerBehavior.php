<?php

class GGamesRankerBehavior extends CModelBehavior {

  public $servername,
         $boname,
         $serverid,
         $boid,
         $name,
         $winner,
         $isbanned,
         $isadmin,
         $date,
         $team,
         $newcolour,
          $kills, $deaths, $assists, $creepkills, $creepdenies, $neutralkills, $towerkills, $gold, 
          $item1, $item2, $item3, $item4,
          $hero, $heroname, $herooriginal, $herodesc, $heroskills, $herostats,
         $left, $leftreason, $server;


  public function  scopes() {
    return array(
        'unrankedGames'=>array(
            'join'=>'INNER JOIN dotagames AS dg ON g.id = dg.gameid',
            'condition'=>'dg.winner > 0 AND g.gamestate < 17',
            'order'=>'g.datetime ASC',
        ),
    );
  }

}
