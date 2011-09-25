<?php
$this->breadcrumbs=array(
	'Monthly',
);?>
<?php
 $pageTitle = "$lang[monthly_top]";

  $year = date("Y");
  $month = date("n");
  $day_ = date("j");
  //$month  = "6"; $year = "2009"; $day_ = "26";

  //$day_stats = " AND $sqlDay= '$day_' ";
  $day_stats = "";

  $sqlYear="YEAR(datetime)";
  $sqlMonth="MONTH(datetime)";
  $sqlMonthName="MONTHNAME(datetime)";
  $sqlDay="DAYOFMONTH(datetime)";

    if (isset($_POST["days"]) AND $_POST["days"]!=0)
  {$day_ = safeEscape($_POST["days"]);
  $day_stats = " AND $sqlDay = '$day_' ";
  } else {$day_ = "";}


  $sql = "SELECT $sqlYear as y, $sqlMonth as m, $sqlMonthName as mn
  FROM games
  GROUP BY $sqlYear
  ORDER BY $sqlYear DESC";

  $result = $db->query($sql);
  ?><form name='myform' method='post' action=''><?php


  ///////// YEARS
  $buildYears = "<select id='yearsid' name='years'>";

   while ($list = $db->fetch_array($result,'assoc'))
   {
   $select = "";
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $year=safeEscape($_POST["years"]);
   $month=safeEscape($_POST["months"]);
    if ($_POST["years"] == $list["y"]) {$select = "selected";} else {$select = "";}
	  }
      $buildYears .= "<option $select value='$list[y]'>$list[y]</option>";
   }
      $buildYears .= "</select>";


  ///////// MONTHS
  $buildMonths = "<select id='monthid' name='months'>";
  for ( $counter = 1; $counter <= 12; $counter += 1) {
  $m = date("n");
  if ($m == $counter) {$select = "selected";} else $select = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($_POST["months"] == $counter) {$select = "selected";} else {$select = "";}
  }

  $MonthName = getMonthName($counter,$lang["jan"],$lang["feb"],$lang["mar"],$lang["apr"],$lang["may"],$lang["jun"],$lang["jul"],$lang["aug"],$lang["sep"],$lang["oct"],$lang["nov"],$lang["dec"]);

  $buildMonths .= "<option $select value='$counter'>$MonthName</option>";
  }
  $buildMonths .= "</select>";


  //DAYS
  if ($DaysOnMonthlyStats == 1)
  {
  $getDays = getDays($month);
  $buildDay = "<select id='dayid' name='days'><option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>";
  for ( $counter = 1; $counter <= $getDays; $counter += 1) {
  //if (isset($_POST["days"]) AND $_POST["days"]!=0 and ($_POST["days"] == $counter))
  //{$selectd = "selected";} else {$selectd = "";}
  $buildDay .= "<option value='$counter'>&nbsp;$counter</option>";
  }
  $buildDay .= "</select>";
  } else {$buildDay = "";}

  if (isset($_POST["days"]) AND $_POST["days"]!=0) {$DisplayDay = $day_;} else {$DisplayDay = ""; echo $day_;}

   $DisplayMonthName = getMonthName($month,$lang["jan"],$lang["feb"],$lang["mar"],$lang["apr"],$lang["may"],$lang["jun"],$lang["jul"],$lang["aug"],$lang["sep"],$lang["oct"],$lang["nov"],$lang["dec"]);

  ?><table>
     <tr>
	     <td><?=$buildDay?> <?=$buildMonths?> <?=$buildYears?> <input type='submit' class='inputButton' value='<?=$lang["submit"]?>' /></td>
	</tr>
    <tr>
    <th><div align='center'><?=$DisplayDay?> <b><?=$DisplayMonthName?></b> <?=$year?></div></th>
    </tr>
  </table>
  </form>
  <?php
  if ($TopRanksOnMonthly == 1)
  { ?><body onload='requestActivities2("includes/ajax_get_monthlytop.php?games=<?=$minGamesPlayed?>&year=<?=$year?>&month=<?=$month?>&day=<?=$day_?>&sqlyear=<?=$sqlYear?>&sqlmonth=<?=$sqlMonth?>&daystats=<?=$day_stats?>");'>
  <div id='divActivities2'></div><?php }

  include('./includes/get_monthly.php'); ?>