<?php

if($status) {
	$class = 'online';
	$text = __('pvpgn.Module','Online');
} else {
	$class = 'offline';
	$text = __('pvpgn.Module','Offline');
}
?>

<span class="label server <?=$class?>"><?=$text?></span>