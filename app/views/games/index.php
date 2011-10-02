<?php
$this->breadcrumbs=array(
	'Games',
);
$this->pageTitle=__('app','Dota Games');
?>

<?php $this->widget('GamesSummary');?>

<?php //@TODO Filter block ?>

<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
	<table id="games" class='list'>
		<thead>
			<tr>
				<th><?= $sort->link('game', __('app', 'Game')); ?></th>
				<th><?= $sort->link('duration', __('app', 'Duration')); ?></th>
				<th><?= $sort->link('type', __('app', 'Type')); ?></th>
				<th><?= $sort->link('date', __('app', 'Date')); ?></th>
				<th><?= $sort->link('creator', __('app', 'Creator')); ?></th>
			</tr>
		</thead>
			<?php if($gamesCount < 1):?>
				<tr>
					<td class="noEntries" colspan="5">
						<?= __('app', 'No Games found'); ?>
					</td>
				</tr>
			<?endif;?>
			<?php foreach($games as $list): ?>
				<?php

					$gid=       $list["id"];
					$map=       CHtml::encode(substr($list["map"], strripos($list["map"], '\\')+1));
					$type=      $list["type"];

					$gametime=  date(param('dateFormat'),strtotime($list["datetime"]));
					$gamename=  trim($list["gamename"]);
					$ownername= $list["ownername"];
					$duration=  Util::secondsToTime($list["duration"]);
					$creator=   trim($list["creatorname"]);
					$creatorId= trim(strtolower($list["creatorname"]));
					$winner=    $list["winner"];

					$gamenameHtmlOptions=array();
					if ($winner == 1) {
						$gamenameHtmlOptions['data-title']=__('app','<b>Map</b>: :map <br> <b>Winner</b> Sentinel',array(':map'=>$map));
						$gamenameHtmlOptions['class']='GamesSentinel';
					}

					if ($winner == 2) {
						$gamenameHtmlOptions['data-title']=__('app','<b>Map</b>: :map <br> <b>Winner</b> Scourge',array(':map'=>$map));
						$gamenameHtmlOptions['class']='GamesScourge';
					}

					if ($winner == 0) {
						$gamenameHtmlOptions['data-title']=__('app','<b>Map</b>: :map <br> <b>Winner</b> Draw Game',array(':map'=>$map));
						$gamenameHtmlOptions['class']='GamesDraw';
					}
				?>
				<tr>
					<td >
							<?=CHtml::link($gamename,
							               array(
							                    'view',
								                  'id'=>$gid
							               ),
							               $gamenameHtmlOptions
							);?>
					</td>
					<td><?=$duration?></td>
					<td><?=$type?></td>
					<td><?=$gametime?></td>
					<td>
							<?=CHtml::link($creator,
							               array(
							                    'players/view',
								                  'id'=>$creatorId
							               )
							);?>
							<?=(!$creator) ? __('app','Autohosted'):'';?>
					</td>
				</tr>
			<?php endforeach; ?>
	</table>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>