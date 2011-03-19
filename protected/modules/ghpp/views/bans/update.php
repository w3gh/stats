<?php

?>

<h1>Update Bans <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'servers'=>$servers)); ?>