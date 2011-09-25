<?php
$this->breadcrumbs=array(
	'Stats',
);?>
<?php
 $pageTitle = "$lang[top_players]";

  $games = $minGamesPlayed;
  $gplay = $minGamesPlayed;
  if (isset($_GET['gp'])) {$games = safeEscape($_GET['gp']);
  $games = preg_replace("/[^0-9]/", '', $games);
  }

  			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
			   if (is_numeric($_POST['gp'])){
			   $gplay = trim(safeEscape($_POST['gp']));
			   $games = $gplay;
			   }
			}

  if ($HideBannedUsersOnTop == 1) $sql_bans=" AND banned = 0"; else $sql_bans= "";

  $sql = "SELECT COUNT(*) FROM stats WHERE games>=$games $sql_bans LIMIT 1";

     $result = $db->query($sql);
	 $r = $db->fetch_row($result);
	 $numrows = $r[0];
	 $result_per_page = $top_players_per_page;
     $order = 'score';

	 if (isset($_GET['order']))
	 	 {
	 	 if ($_GET['order'] == 'score') {$order = ' score ';}
	 	 if ($_GET['order'] == 'name') {$order = ' LOWER(player) ';}
	 	 if ($_GET['order'] == 'deaths') {$order = ' deaths ';}
	 	 if ($_GET['order'] == 'kills') {$order = ' kills ';}
	 	 if ($_GET['order'] == 'losses') {$order = ' losses ';}
		 if ($_GET['order'] == 'assists') {$order = ' assists ';}
		 if ($_GET['order'] == 'ratio') {$order = ' killdeathratio ';}
		 if ($_GET['order'] == 'creeps') {$order = ' creeps ';}
		 if ($_GET['order'] == 'denies') {$order = ' denies ';}
		 if ($_GET['order'] == 'neutrals') {$order = ' neutrals ';}
		 if ($_GET['order'] == 'games') {$order = ' games ';}
		 if ($_GET['order'] == 'wins') {$order = ' wins ';}
	 	 }

		 $sort = 'ASC';
		 $sortdb = 'ASC';
		 $page_ = '&page=1';

		 if (!isset($_GET['sort'])) {$sort = "asc"; $sortdb = "DESC";}

		 if (isset($_GET['sort']) AND $_GET['sort'] == 'desc')
		 {$sort = 'asc'; $sortdb = 'ASC';} else {$sort = 'desc'; $sortdb = 'DESC';}



		 /*
		      //////////////////////////////////
		     //Dont reset pages on sorting???//
		    //////////////////////////////////

		 if (isset($_GET['page']) )
		 {$page_ = '&page='.safeEscape($_GET['page']);}

		 */

	 include('pagination.php');


	 ?><div style='margin-right:24px;' align='right'>
	 <?php echo $lang["showing"];
	 echo $offset+1;
	 echo " - ";
	 echo $offset+$rowsperpage;
	 echo "</div>";

	 $sql = "SELECT
	 player,
	 score,
	 games,
	 wins,
	 losses,
	 draw,
	 kills,
	 deaths,
	 assists,
	 creeps,
	 denies,
	 neutrals,
	 towers,
	 banned,
	 ip
	 FROM stats
	 WHERE games>=$games
	 $sql_bans
	 GROUP BY player
	 ORDER BY $order $sortdb, player $sortdb
	 LIMIT $offset, $rowsperpage";

	 $result = $db->query($sql);

     $data = array($lang["min_games_played"],
	 $lang["update"],
	 $games,
	 "<a href='{$_SERVER['PHP_SELF']}?".$gplay."order=name&sort=$sort".$page_."'>$lang[name]</a>",
	 "<a href='{$_SERVER['PHP_SELF']}?".$gplay."&order=score&sort=$sort".$page_."'>$lang[score]</a>",
	 "<a href='{$_SERVER['PHP_SELF']}?".$gplay."&order=games&sort=$sort".$page_."'>$lang[games]</a>",
	 "<a href='{$_SERVER['PHP_SELF']}?".$gplay."&order=wins&sort=$sort".$page_."'>$lang[wins]</a>",
	 "<a href='{$_SERVER['PHP_SELF']}?".$gplay."&order=losses&sort=$sort".$page_."'>$lang[losses]</a>",
	 "$lang[kills]",
	 "$lang[deaths]",
	 "$lang[assists]",
	 "$lang[kd]",
	 "$lang[creeps]",
	 "$lang[denies]",
	 "$lang[neutrals]",);

   $tags = array('{%MINGAMES%}','{%UPDATE%}','{GAMES_VALUE}','{%NAME%}', '{%SCORE%}', '{%GAMES%}', '{%WINS%}', '{%LOSSES%}', '{%KILLS%}', '{%DEATHS%}', '{%ASSISTS%}', '{%RATIO%}', '{%CREEPS%}', '{%DENIES%}', '{%NEUTRALS%}');

   echo str_replace($tags, $data, file_get_contents("./style/$default_style/top.html"));

  /*
  */
	 $counter = 1; //  $top_players_per_page
	 if (isset($_GET['page'])) {$counter = ($top_players_per_page * $_GET['page']) - $top_players_per_page+1;}


	 while ($list = $db->fetch_array($result,'assoc')) {

		$name=trim($list["player"]);
		$name2=trim(strtolower($list["player"]));
		$banname=$list["banned"];
		//echo "$name ".$list["disc"]." | " ;
		$myFlag = "";
		$IPaddress = $list["ip"];

		//COUNTRY FLAGS
		if ($CountryFlags == 1 AND file_exists("./includes/ip_files/countries.php")  AND $IPaddress!="")
		{
		if (strtolower($name) == "neubivljiv") {$IPaddress = "0.0.0.0";}
		$two_letter_country_code=iptocountry($IPaddress);
		include("./includes/ip_files/countries.php");
		$three_letter_country_code=$countries[$two_letter_country_code][0];
        $country_name=convEnt2($countries[$two_letter_country_code][1]);
		$file_to_check="./includes/flags/$two_letter_country_code.gif";
		if (file_exists($file_to_check)){
		        $flagIMG = "<img src=$file_to_check>";
                $flag = "<img onMouseout='hidetooltip()' onMouseover='tooltip(\"".$flagIMG." $country_name\",100); return false' src='$file_to_check' width='20' height='13'>";
                }else{
                $flag =  "<img title='$country_name' src='./includes/flags/noflag.gif' width='20' height='13'>";
                }
		$myFlag = $flag;
		}

		if (trim(strtolower($banname)) == strtolower($name) AND $WarnAndExpireDate == 0)
		{$name = "$flag <span style='color:#BD0000'>$list[name]</span>";}

		$totgames=$list["games"]."";
		//AVG
		$kills=ROUND($list["kills"]/$totgames,1);
		$death=ROUND($list["deaths"]/$totgames,1);
		//TOTAL
		$totkills=ROUND($list["kills"],1);
		$totdeath=ROUND($list["deaths"],1);
		$assists=ROUND($list["assists"]/$totgames,1);
		$creepkills=ROUND($list["creeps"]/$totgames,1);
		$creepdenies=ROUND($list["denies"]/$totgames,1);
		$neutralkills=ROUND($list["neutrals"]/$totgames,1);
		//$courierkills=ROUND($list["neutrals"],1);
		$wins=$list["wins"];
		$losses=$list["losses"];
		$totalscore=ROUND($list["score"],2);
		$totdisc = $list["banned"];

		if ($totdeath >=1)
	    {$killdeathratio = ROUND($totkills*1.0/$totdeath*1.0,1);} else {$killdeathratio = $totkills;}

		if ($totdeath == 0)
	    {$killdeathratio = 1000;}

		if ($totkills == 0)
	    {$killdeathratio = 0;}

		if ($wins <=0)
		{$winlosses = 0;}
		else
		if($wins == 0 and $wins+$losses == 0){ $winlosses = 0;}
		else
		if($wins+$losses == 0){$winlosses = 1000;}
		else
		if ($wins >0)
		{$winlosses = ROUND($wins/($wins+$losses), 3)*100;}


		//$killdeathratio=ROUND($list["killdeathratio"],1);


		  $data = array($counter, $name2, $name, $totalscore, $totgames, $wins ,$winlosses,$losses, $kills, $death,$assists,$killdeathratio,$creepkills,$creepdenies,$neutralkills, $myFlag);

   $tags = array('{%COUNTER%}','{%NAME_URL%}', '{%NAME%}', '{%SCORE%}', '{%TOTGAMES%}', '{%WINS%}', '{%WINLOSSES%}','{%LOSSES%}','{%KILLS%}', '{%DEATHS%}', '{%ASSISTS%}', '{%KDRATIO%}', '{%CK%}', '{%CD%}','{%NEUTRALS%}','{%FLAG%}'
   );

   echo str_replace($tags, $data, file_get_contents("./style/$default_style/top_row.html"));

		/*
		*/
		$counter++;
		echo "";

		}
		echo "</table><br/>";
		include('pagination.php');

	//include('./includes/get_tops.php');
   //if ($AllTimeStats == 1)
   //{
   //echo " <body onload='requestActivities2(\"includes/get_tops.php?alltimestats\");'> ";
   //echo "<div id='divActivities2'></div>";}
   ?>