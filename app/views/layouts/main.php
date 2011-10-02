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

	<link rel="stylesheet" href="<?=$this->assetsUrl?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=app()->theme->baseUrl?>/assets/css/style.css">

	<!-- All JavaScript at the bottom, except this Modernizr build incl. Respond.js
       Respond is a polyfill for min/max-width media queries. Modernizr enables HTML5 elements & feature detects;
       for optimal performance, create your own custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?=$this->assetsUrl?>js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body id="theme-<?=app()->theme->name?>">
<div class="topbar">
	<div class="topbar-inner">
		<div class="container">
			<?= CHtml::link(app()->name,'',array('class'=>'brand')); ?>
			<?php $this->widget('zii.widgets.CMenu',array(
				'id'=>'menu',
				'htmlOptions'=>array(
					'class'=>'nav'
				),
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'Admins', 'url'=>array('/admins')),
					array('label'=>'Bans', 'url'=>array('/bans')),
					array('label'=>'Games', 'url'=>array('/games')),
					array('label'=>'Items', 'url'=>array('/items')),
					array('label'=>'Heroes', 'url'=>array('/heroes')),
					array('label'=>'About', 'url'=>array('/site/page', 'id'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>app()->user->isGuest),
					array('label'=>'Logout ('.app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!app()->user->isGuest)
				),
			)); ?>
			<?php if(!empty($this->menu)):?>
				<ul class="nav secondary-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" href="#">Operations</a>
						<?php
								$this->widget('zii.widgets.CMenu', array(
									'items'=>$this->menu,
									'htmlOptions'=>array('class'=>'dropdown-menu'),
								));?>
	<!--					<ul class="dropdown-menu">-->
	<!--						<li><a href="#">Secondary link</a></li>-->
	<!--						<li><a href="#">Something else here</a></li>-->
	<!--						<li class="divider"></li>-->
	<!--						<li><a href="#">Another link</a></li>-->
	<!--					</ul>-->
					</li>
				</ul>
			<?php endif;?>
			<p class="pull-right">Hello World</p>
		</div>
	</div>
</div>

<div class="container" id="page">
	<div id="header" class="row header">

	</div>

	<?= $content; ?>

	<div id="footer" class="row footer">

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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?=$this->assetsUrl?>js/libs/jquery-1.6.3.min.js"><\/script>')</script>

	<!-- twitter bootstrap.js -->
	<script defer src="<?=$this->assetsUrl?>js/libs/bootstrap/bootstrap-dropdown.js"></script>
	<script defer src="<?=$this->assetsUrl?>js/libs/bootstrap/bootstrap-modal.js"></script>
	<script defer src="<?=$this->assetsUrl?>js/libs/bootstrap/bootstrap-popover.js"></script>
	<script defer src="<?=$this->assetsUrl?>js/libs/bootstrap/bootstrap-alerts.js"></script>

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