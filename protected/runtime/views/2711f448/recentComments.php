<?php /* source file: /home/jilizart/www/Yii/apps/w3ghstats/protected/components/widgets/views/recentComments.php */ ?>
<ul>
	<?php foreach($this->getRecentComments() as $comment): ?>
	<li><?php echo $comment->authorLink; ?> on
		<?php echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl()); ?>
	</li>
	<?php endforeach; ?>
</ul>