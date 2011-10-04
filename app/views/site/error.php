<?php
$this->pageTitle=__('app','Error');
$this->breadcrumbs=array(
	__('app','Error'),
);
?>

<h2><?=__('app','Error').' '.$code?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>