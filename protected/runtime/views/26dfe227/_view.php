<?php /* source file: /home/jilizart/www/Yii/apps/w3ghstats/protected/views/post/_view.php */ ?>
<div id="post-<?php print $data->id; ?>" class="post">
	<h3 class="title"><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h3>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
  	<div class="author">
    <?php echo Yii::t('yii', 'Posted by {author} on {date}', array(
      '{author}'=>$data->author->username,
      '{date}'=>date('F j, Y',$data->create_time))); ?>
	</div>
	<div class="meta">
    <div class="tags">
      <b><?php echo Yii::t('yii', 'Tags'); ?></b>
      <?php echo implode(', ', $data->tagLinks); ?>
    </div>
    <div class="submited">
      <ul class="links inline">
        <li><?php echo CHtml::link(Yii::t('yii', 'Permalink') , $data->url); ?></li>
        <li><?php echo CHtml::link(Yii::t('yii', 'Comments ({count})', array('{count}'=>$data->commentCount)),$data->url.'#comments'); ?></li>
        <li><?php echo Yii::t('yii', 'Last update {date}', array('{date}'=>date('F j, Y',$data->update_time))); ?></li>
      </ul>
    </div> 
    <div class="clear"></div>
	</div>
</div>
