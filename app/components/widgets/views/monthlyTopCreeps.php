<table>


	$stepDeaths = "SELECT original as topHero, description as topHeroName, deaths as topValue, b.name as topUser, a.gameid as topGame
		FROM dotaplayers AS a 
		LEFT JOIN gameplayers AS b ON b.gameid = a.gameid and a.colour = b.colour 
		LEFT JOIN games as c on a.gameid = c.id 
        LEFT JOIN bans on b.name = bans.name 		
		JOIN heroes as d on hero = heroid WHERE $sqlYear = '$year' AND $sqlMonth = '$month' $day_stats
		 $hide_banned  ORDER BY topValue DESC, a.id ASC LIMIT $monthly_stats";

	$result = $db->query($stepDeaths);
	while ($list = $db->fetch_array($result, 'assoc')) {
		$himg = strtoupper($list["topHero"]);
		if ($list["topValue"] > 0) {
			echo "<tr class='row'><td align='left' width='180'><a href='hero.php?hero=$list[topHero]' title='$list[topHeroName]'>
		 <img style='vertical-align: middle;' width='32' height='32' src='img/heroes/$himg.gif' border=0/></a>
		 (<a href='game.php?gameid=$list[topGame]'>$list[topValue]</a>) 
		 
		 <a href='user.php?u=$list[topUser]' title='$list[topUser]'>$list[topUser]</a>
		 </td></tr>
		 ";
		} else {
			echo "<tr class='row'><td width='180'></td></tr>";
		}
	}

</table>