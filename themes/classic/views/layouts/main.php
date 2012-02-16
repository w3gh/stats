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

    <link rel="stylesheet" href="<?=app()->theme->baseUrl?>/assets/css/style<?=(YII_DEBUG)?'':'.min'?>.css">

	<!-- All JavaScript at the bottom, except this Modernizr build incl. Respond.js
       Respond is a polyfill for min/max-width media queries. Modernizr enables HTML5 elements & feature detects;
       for optimal performance, create your own custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?=$this->assetsUrl?>js/libs/modernizr-2.0.6.min.js"></script>

</head>

<body id="theme-<?=app()->theme->name?>">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <?= CHtml::link(app()->name,'',array('class'=>'brand')); ?>
            <div class="nav-collapse">
                <?php $this->widget('zii.widgets.CMenu',array(
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
                <p class="navbar-text pull-right"><?=(app()->user->isGuest) ?
                    __('app','Please <a href=":login">Login</a>',array(':login'=>$this->createUrl('/user/default/login'))):
                    __('app','Logged in as <a href="#">:username</a>',array(':username'=>app()->user->name))?>
                </p>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid" id="page">

	<?=CHtml::tag('h1',array('class'=>'title'),$this->title)?>

	<?= $content; ?>

	<div id="footer" class="footer row">

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

	</div><!-- footer -->

</div><!-- page -->


<!-- JavaScript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery<?=(YII_DEBUG)?'':'.min'?>.js"></script>
<script>window.jQuery || document.write('<script src="<?=$this->assetsUrl?>js/libs/jquery-1.7.1<?=(YII_DEBUG)?'':'.min'?>.js"><\/script>')</script>

<!-- twitter bootstrap.js -->
<script src="<?=$this->assetsUrl?>js/libs/bootstrap<?=(YII_DEBUG)?'':'.min'?>.js"></script>
<!-- scripts concatenated and minified via build script -->
<script defer src="<?=$this->assetsUrl?>js/plugins.js"></script>
<script defer src="<?=$this->assetsUrl?>js/script.js"></script>
<!-- end scripts -->


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
