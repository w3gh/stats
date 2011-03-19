<?php
/**
 *
 *
 *
 *
 */

/**
 *
 * @author Nicholas Kostyurin
 */
class GTCP extends GSocket
{

	const NewLine="\r\n";


	public function writeLine($data=null)
	{
	 return $this->write($data.self::NewLine);
	}

}
