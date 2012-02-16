<?php
$this->breadcrumbs=array(
	'Dota Games',
);
$this->pageTitle=$this->title=__('app','Dota Games');
?>

<?php $this->widget('GamesSummary');?>

<?php //@TODO Filter block ?>

<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
	<table id="games" class='list zebra-striped'>
		<thead>
			<tr>
				<th>
					<?= $sort->link('game', __('app', 'Game')); ?>
					<span class="label type"><?= $sort->link('type', __('app', 'Type')); ?></span>

				</th>
				<th><?= $sort->link('duration', __('app', 'Duration')); ?></th>
				<th><?= $sort->link('date', __('app', 'Date')); ?></th>
				<th><?= $sort->link('creator', __('app', 'Creator')); ?></th>
                <th>
                    <?=__('app','Server')?>

                </th>
			</tr>
            <tr>
                <th>
                    <div class="btn-group" data-toggle="buttons-checkbox">
                        <button class="btn btn-primary active"><?=__('app', 'Public')?></button>
                        <button class="btn btn-primary active"><?=__('app', 'Private')?></button>
                    </div>
                </th>
                <th>
                <?$this->widget('zii.widgets.jui.CJuiSlider',array(
                    'options'=>array(
                        'range'=>true,
                        'min'=>5,
                        'max'=>200,
                        'values'=>array(75, 300)
                    )
                ))?>
                </th>
                <th>
                    <?$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'date',
                ))?>
                </th>
                <th>
                    <?$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                                        'name'=>'date',
                                    ))?>
                </th>
                <th>
                    <div class="btn-group" data-toggle="buttons-checkbox">
                        <button class="btn btn-primary active">eurobattle.net</button>
                        <button class="btn btn-primary active">eswest</button>
                        <button class="btn btn-primary active">rubattle.net</button>
                    </div>
                </th>
            </tr>
		</thead>
			<?php if($gamesCount < 1):?>
				<tr>
					<td class="noEntries" colspan="6">
						<?= __('app', 'No Games found'); ?>
					</td>
				</tr>
			<?endif;?>
			<?php foreach($games as $list): ?>
				<?php

					$gid=       $list["id"];
					$map=       CHtml::encode(substr($list["map"], strripos($list["map"], '\\')+1));
					$type=      ($list["gamestate"] == 17) ? 'Private':'Public';

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
						<span class="label type <?=strtolower($type)?>"><?=__('app',$type)?></span>
					</td>
					<td><?=$duration?></td>
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
                    <td>Server</td>
				</tr>
			<?php endforeach; ?>
	</table>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>