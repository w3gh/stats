<?php /* source file: /home/jilizart/www/Yii/apps/w3ghstats/themes/w3ghs/views/layouts/main.php */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
      <title><?php /* line 5 */ echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div id="header-region" class="clearfix">
          <div class="wrapper">
            <?php /* line 11 */ $this->widget('zii.widgets.CMenu', array('items'=>$this->menu_top->toArray(), 'htmlOptions'=>array('class'=>'links inline'))); ?>
          </div>
        </div>
        <div id="wrapper">
         <div id="container" class="clearfix">
         
            <div id="header">
                <div id="logo-container">
                    <h1><a title="demo W3ghs" href="<?php /* line 19 */ echo $this->baseUrl ?>"><img src="<?php /* line 19 */ echo $this->assetsPath ?>/images/logo.png" alt="W3GHS"/></a></h1>
                </div>
            </div>

            <div id="navigation" class="clearfix">
                <?php /* line 24 */ $this->widget('zii.widgets.CMenu', array('items'=>$this->menu->toArray(), 'htmlOptions'=>array('class'=>'links inline grid_12'))); ?>
                  <div class="search grid_4">
                    <?php /* line 27 */ $form=$this->beginWidget('CActiveForm', array(
                      'action'=>Yii::app()->createUrl('ghpp/players/index'),
                      'method'=>'get',
                    )); ?>
                    <?php /* line 31 */ $this->widget('CAutoComplete',
                          array(
                             'model'=>new Players('search'),
                             'name'=>'Players[name]',
                             'url'=>array('/ghpp/players/autocompleteplayername'),
                             'minChars'=>2,
                             'cssFile'=>false,
                             'htmlOptions'=>array('class'=>'form-autocomplete'),
                             )); ?>
                    <?php /* line 41 */ echo CHtml::submitButton('Search'); ?>
                    <?php /* line 42 */ $this->endWidget(); ?>
                  </div>
            </div><!-- /#navigation -->

            <div id="content" class="clearfix">
              <div id="wrapper" class="clearfix">
                <div class="top-corner">
                  <div class="bottom-corner">
                    <div class="container_16">
  
                      <div id="main">
<!--                         <h1><?php /* line 53 */ echo $this->pageTitle ?></h1> -->
                        <div class="breadcrumbs grid_7">
                          <?php /* line 55 */ $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs, 'htmlOptions'=>array('class'=>'breadcrumb'))); ?><!-- breadcrumbs -->
                        </div>

                        <div class="tabs grid_9">
                          <?php /* line 59 */ $this->widget('zii.widgets.CMenu', array('items'=>$this->tabs->toArray(), 'htmlOptions'=>array('class'=>'links inline'))); ?>
                        </div>
                        <div class="clear"></div>
                        <div class="page-content clearfix">
                               <?php /* line 63 */ echo $content; ?>
                             
                          <div class="clear"></div>
                        </div><!-- /page-content -->
                      </div><!-- /#main -->
                      
                    </div><!-- /.container_16 -->
                    <div class="clear"></div>
                  </div><!-- /.bottom-corner -->
                </div><!-- /.top-corner -->
              </div><!-- /#wrapper -->
            </div><!-- /#content -->
            
          </div><!-- /#container -->
        </div><!-- /#wrapper -->

        <!-- <div id="fourcols" class="clearfix">
            <div class="wrapper container_12">
                <div class="column grid_3">
                    <h2>Column Heading 1</h2>
                    <div class="content">
                        Column Content
                    </div>
                </div>
                <div class="column grid_3">
                    <h2>Column Heading 2</h2>
                    <div class="content">
                        Column Content
                    </div>
                </div>
                <div class="column grid_3">
                    <h2>Column Heading 3</h2>
                    <div class="content">
                        Column Content
                    </div>
                </div>
                <div class="column grid_3">
                    <h2>Column Heading 4</h2>
                    <div class="content">
                        Column Content
                    </div>
                </div>
            </div>
        </div> /#fourclos -->

        <div id="footer">
            <div class="wrapper container_12">
                <div class="leftside grid_7">
                    <ul class="links inline">
                        <li><a href="#">License</a></li>
                        <li><a href="#">Contact</a></li>
                        <li>&copy; <?php /* line 114 */ echo date('Y'); ?> JiLiZART. All Rights Reserved.</li>
                        <li><?php /* line 115 */ echo Yii::powered(); ?></li>
                    </ul>
                </div>
                <div class="rightside grid_5">
                    <ul class="inline links">
                      <li><?php echo Yii::t('layout','{time} sec',array('{time}'=>sprintf('%0.5f',Yii::getLogger()->getExecutionTime()))); ?></li>
                      <li><?php echo Yii::t('layout', '{mem} KB',array('{mem}'=>number_format(Yii::getLogger()->getMemoryUsage()/1024))); ?></li>
                      <li><?php echo Yii::t('layout', '{query} queries',array('{query}'=>array_shift(Yii::app()->getDb()->getStats())))?></li>
                    </ul>
                </div>

                <div class="clear"></div>
            </div><!-- /.wrapper -->
        </div><!-- /#footer -->
    </body>
</html>