
<?php
$this->widget('zii.widgets.grid.CGridView', array(
   'dataProvider'=>$dataProvider,
    'columns'=>array(
        'name',
        'games',
        'kills',
        'deaths',
        'assists',
    ),
));

?>