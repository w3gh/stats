<?/** @var $this Controller */
$min=(YII_DEBUG)?'':'.min';//check,need use a minified version?
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
 More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?= CHtml::encode($this->pageTitle) ?></title>

    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?$this->cssFile(app()->theme->assetsUrl.'css/style'.$min.'.css','screen'); ?>

    <?$this->jsFile($this->assetsUrl.'js/libs/modernizr'.$min.'.js',0/*is a POS_HEAD*/)
    ->jsFile($this->assetsUrl.'js/libs/bootstrap'.$min.'.js')
    ->jsFile($this->assetsUrl.'js/plugins/waypoints/waypoints'.$min.'.js')
    ->jsFile($this->assetsUrl.'js/plugins.js')
    ->jsFile($this->assetsUrl.'js/script.js')?>

</head>

<body id="theme-<?=app()->theme->name?>">

<div class="container-fluid" id="page">

    <div id="top-navbar" class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <?= CHtml::link(app()->name,array(''),array('class'=>'brand')); ?>
                <div class="nav-collapse">
                    <?$this->widget('zii.widgets.CMenu',array(
                    				'id'=>'menu',
                    				'htmlOptions'=>array(
                    					'class'=>'nav'
                    				),
                    				'items'=>array(
                    					array('label'=>'Admins', 'url'=>array('/ghost/admins')),
                    					array('label'=>'Bans', 'url'=>array('/ghost/bans')),
                    					array('label'=>'Games', 'url'=>array('/ghost/games')),
                    					array('label'=>'Items', 'url'=>array('/ghost/items')),
                    					array('label'=>'Heroes', 'url'=>array('/ghost/heroes')),
                    					array('label'=>'About', 'url'=>array('/site/page', 'id'=>'about')),
                    					array('label'=>'Contact', 'url'=>array('/site/contact')),
                    				),
                    			)); ?>

                    <?if(app()->user->isGuest):?>

                    <p class="navbar-text pull-right">
                        <?=__('app','Please <a href=":login">Login</a>',array(':login'=>$this->createUrl('/user/default/login')))?>
                    </p>

                    <?else:?>

                    <ul class="nav pull-right">
                        <li>
                            <?=__('app','<a href="#">Logged in as <strong>:username</strong></a>',array(':username'=>app()->user->name))?>
                        </li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
                            <?$this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'dropdown-menu'),
                            'items'=>$this->menu,
                                ))?>
                            <!--                              <ul class="dropdown-menu">-->
                            <!--                                <li><a href="#">Action</a></li>-->
                            <!--                                <li><a href="#">Another action</a></li>-->
                            <!--                                <li><a href="#">Something else here</a></li>-->
                            <!--                                <li class="divider"></li>-->
                            <!--                                <li><a href="#">Separated link</a></li>-->
                            <!--                              </ul>-->
                        </li>
                    </ul>
                    <?endif;?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

	<?=CHtml::tag('h1',array('class'=>'title'),$this->title)?>

	<?= $content; ?>

	<footer id="footer" class="footer row">

			<div class="span10">
				<ul class="inline links unstyled">
					<li><?= __('app','{time} sec',array('{time}'=>sprintf('%0.5f',Yii::getLogger()->executionTime))); ?></li>
					<li><?= __('app', '{mem} MB',array('{mem}'=>number_format(Yii::getLogger()->memoryUsage/1024))); ?></li>
					<li><?= __('app', '{query} queries',array('{query}'=>array_shift(app()->db->getStats())))?></li>
				</ul>
			</div>

			<div class="span6">
				Copyright &copy; <?php echo date('Y'); ?> by JiLiZART.<br/>
				All Rights Reserved.<br/>
				<?= Yii::powered(); ?>

			</div>

                <a class="btn btn-top" href="#" title="Back to top"><i class="icon-arrow-up"></i></a>
	</footer><!-- footer -->

</div><!-- page -->

<?php if($analyticsAccount = param('analyticsAccount')): ?>
<!-- Asynchronous Google Analytics snippet. Change analyticsAccount in params to be your site's ID.
mathiasbynens.be/notes/async-analytics-snippet -->
<script>
    var _gaq=[['_setAccount','<?= $analyticsAccount ?>'],['_trackPageview'],['_trackPageLoadTime']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif;?>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

</body>
</html>
