<div class="grid_16">
  <h1>Error <?php echo $code; ?></h1>
  <h2><?php echo nl2br(CHtml::encode($message)); ?></h2>
  <hr />
  <div class="version small">
  <?php echo date('Y-m-d H:i:s', $time) .' '. $version; ?>
  </div>
</div>