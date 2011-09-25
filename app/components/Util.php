<?php



class Util {

	/**
	 * @static
	 * @param $seconds
	 * @return string  the time like 1:43:32
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
			return $hours."h".$minutes."m".$seconds_left."s";
		}
		else
		{
			if(strlen($seconds_left) == 1)
			{
				$seconds_left = "0".$seconds_left;
			}
			return $minutes."m".$seconds_left."s";
		}
	}

	/**
	 * @static
	 * @param $milliseconds
	 * @return string the time like 5.2 (5 seconds, 200 milliseconds)
	 */
	public static function millisecondsToTime($milliseconds)
	{
		$return="";
		$return2="";

		// get the seconds
		$seconds = floor($milliseconds / 1000) ;
		$milliseconds = $milliseconds % 1000;
		$milliseconds = round($milliseconds/100,0);

		// get the minutes
		$minutes = floor($seconds / 60);
		$seconds_left = $seconds % 60;

		// get the hours
		$hours = floor($minutes / 60);
		$minutes_left = $minutes % 60;
		
		// A little unneccasary with minutes and hours,,  but HEY  every thing's possible
		if($hours)
			$return =$hours."h ";

		if($minutes_left)
			$return2 =$minutes_left."m ";
		
		return $return.$return2.$seconds_left.".".$milliseconds;
	}
}