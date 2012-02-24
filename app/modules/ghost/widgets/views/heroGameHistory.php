<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<table class="list zebra-striped">
    <thead>
    <tr>
        <th colspan="11"><?=__('app','Player History for :hero',array(':hero'=>$heroName))?></th>
    </tr>
    <tr>
        <th>
            <?= $sort->link('player', __('app', 'Player')); ?>
        </th>
        <th>
            <?= $sort->link('game', __('app', 'Game')); ?>
            <span class="label type"><?= $sort->link('type', __('app', 'Type')); ?></span>
        </th>
        <th><?= $sort->link('result', __('app', 'Result')); ?></th>
        <th><?= $sort->link('kills', __('app', 'Kills')); ?></th>
        <th><?= $sort->link('deaths', __('app', 'Deaths')); ?></th>
        <th><?= $sort->link('assists', __('app', 'Assists')); ?></th>
        <th><?= $sort->link('kd', __('app', 'K\D')); ?></th>
        <th><?= $sort->link('creeps', __('app', 'Creeps')); ?></th>
        <th><?= $sort->link('denies', __('app', 'Denies')); ?></th>
        <th><?= $sort->link('neutrals', __('app', 'Neutrals')); ?></th>
    </tr>
    </thead>

    <tbody>
    <?php if($heroesCount < 1):?>
    <tr>
        <td class="noEntries" colspan="12">
            <?= __('app', 'No Games found'); ?>
        </td>
    </tr>
        <?endif;?>

    <?php foreach($games as $list): ?>
        <?php
        $gameid =     $list["gameid"];
        $kills=       $list["kills"];
        $death=       $list["deaths"];
        $assists=     $list["assists"];
        $kdratio=     round($list["kdratio"],2);
        $gamename=    CHtml::encode(trim($list["gamename"]));
        $banname=     $list["banname"];

        $name=        CHtml::encode($list["name"]);
        $nameUrl=     trim(strtolower($list["name"]));

        $win =        $list["winner"];
        $winner=      $list["result"];
        $type=        $list["type"];
        $creepkills=  $list["creepkills"];
        $creepdenies= $list["creepdenies"];
        $neutralkills=$list["neutralkills"];
        $towerkills=  $list["towerkills"];
        $raxkills=    $list["raxkills"];
        ?>
    <tr>
        <td style='padding-left:4px;width:160px;' ><?//=$myFlag?> <?=CHtml::link($name,array('players/view','id'=>$nameUrl)); ?></td>
        <td width='220'>
            <?=CHtml::link($gamename,array('games/view',array('id'=>$gameid))); ?>
            <span class="label type <?=strtolower($type)?>"><?=__('app',$type)?></span>
        </td>
        <td width='64'><?=$winner?></td>
        <td width='56'><div align='center'><?=$kills?></div></td>
        <td width='56'><div align='center'><?=$death?></div></td>
        <td width='56'><div align='center'><?=$assists?></div></td>
        <td width='56'><div align='center'><?=$kdratio?></div></td>
        <td width='56'><div align='center'><?=$creepkills?></div></td>
        <td width='56'><div align='center'><?=$creepdenies?></div></td>
        <td width='56'><div align='center'><?=$neutralkills?></div></td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
