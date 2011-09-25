<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css">
	<style type="text/css">
		body{
			padding-top: 40px;
		}
	</style>
	<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){

	  // Dropdown example for topbar nav
	  // ===============================

	  $("body").bind("click", function (e) {
	    $('.dropdown-toggle, .menu').parent("li").removeClass("open");
	  });
	  $(".dropdown-toggle, .menu").click(function (e) {
	    var $li = $(this).parent("li").toggleClass('open');
	    return false;
	  });


	  // table sort example
	  // ==================

	  //$("#sortTableExample").tablesorter( {sortList: [[1,0]]} );


	  // add on logic
	  // ============

	  $('.add-on :checkbox').click(function() {
	    if ($(this).attr('checked')) {
	      $(this).parents('.add-on').addClass('active');
	    } else {
	      $(this).parents('.add-on').removeClass('active');
	    }
	  });


	  // Disable certain links in docs
	  // =============================

	  /* $('ul.tabs a, ul.pills a, .pagination a, .well .btn, .actions .btn, .alert-message .btn, a.close').click(function(e) {
	    e.preventDefault();
	  }); */

	  // Copy code blocks in docs
	  /*$(".copy-code").focus(function() {
	    var el = this;
	    // push select to event loop for chrome :{o
	    setTimeout(function () { $(el).select(); }, 1);
	  }); */


	  // POSITION TWIPSIES
	  // =================
/*
	  $('.twipsies.well a').each(function () {
	    var type = this.title
	      , $anchor = $(this)
	      , $twipsy = $('.twipsy.' + type)

	      , twipsy = {
	          width: $twipsy.width() + 10
	        , height: $twipsy.height() + 10
	        }

	      , anchor = {
	          position: $anchor.position()
	        , width: $anchor.width()
	        , height: $anchor.height()
	        }

	      , offset = {
	          above: {
	            top: anchor.position.top - twipsy.height
	          , left: anchor.position.left + (anchor.width/2) - (twipsy.width/2)
	          }
	        , below: {
	            top: anchor.position.top + anchor.height
	          , left: anchor.position.left + (anchor.width/2) - (twipsy.width/2)
	          }
	        , left: {
	            top: anchor.position.top + (anchor.height/2) - (twipsy.height/2)
	          , left: anchor.position.left - twipsy.width - 5
	          }
	        , right: {
	            top: anchor.position.top + (anchor.height/2) - (twipsy.height/2)
	          , left: anchor.position.left + anchor.width + 5
	          }
	      }

	    $twipsy.css(offset[type])

	  });
 */
	});



		document.onclick = check;

		var Ary = [];

		function check(e) {
			var target = (e && e.target) || (event && event.srcElement);
			while (target.parentNode) {
				if (target.className.match('pop') || target.className.match('poplink')) return;
				target = target.parentNode;
			}
			var ary = zxcByClassName('pop')
			for (var z0 = 0; z0 < ary.length; z0++) {
				ary[z0].style.display = 'none';
			}
		}
		function zxcByClassName(nme, el, tag) {
			if (typeof(el) == 'string') el = document.getElementById(el);
			el = el || document;
			for (var tag = tag || '*',reg = new RegExp('\\b' + nme + '\\b'),els = el.getElementsByTagName(tag),ary = [],z0 = 0; z0 < els.length; z0++) {
				if (reg.test(els[z0].className)) ary.push(els[z0]);
			}
			return ary;
		}

		function toggle2(layer_ref) {
			var hza = document.getElementById(layer_ref);
			if (hza && hza.style) {
				if (!hza.set) {
					hza.set = true;
					Ary.push(hza);
				}
				hza.style.display = (hza.style.display == '') ? 'show' : '';
			}
		}


		function showhide(id) {
			if (document.getElementById) {
				obj = document.getElementById(id);
				if (obj.style.display == "none") {
					obj.style.display = "";
				} else {
					obj.style.display = "none";
				}
			}
		}
		//-->


		///////////////////// TOOLTiP //////////////////

		var offsetfromcursorX = 12 //Customize x offset of tooltip
		var offsetfromcursorY = 10 //Customize y offset of tooltip

		var offsetdivfrompointerX = 10 //Customize x offset of tooltip DIV relative to pointer image
		var offsetdivfrompointerY = 14 //Customize y offset of tooltip DIV relative to pointer image. Tip: Set it to (height_of_pointer_image-1).

		document.write('<div id="dhtmltooltip"></div>') //write out tooltip DIV
		document.write('<img id="dhtmlpointer" src="img/arrow.gif">') //write out pointer image

		var ie = document.all
		var ns6 = document.getElementById && !document.all
		var enabletip = false
		if (ie || ns6)
			var tipobj = document.all ? document.all["dhtmltooltip"] : document.getElementById ? document.getElementById("dhtmltooltip") : ""

		var pointerobj = document.all ? document.all["dhtmlpointer"] : document.getElementById ? document.getElementById("dhtmlpointer") : ""

		function ietruebody() {
			return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body
		}

		function tooltip(thetext, thewidth, thecolor) {
			if (ns6 || ie) {
				if (typeof thewidth != "undefined") tipobj.style.width = thewidth + "px"
				if (typeof thecolor != "undefined" && thecolor != "") tipobj.style.backgroundColor = thecolor
				tipobj.innerHTML = thetext
				enabletip = true
				return false
			}
		}

		function positiontip(e) {
			if (enabletip) {
				var nondefaultpos = false
				var curX = (ns6) ? e.pageX : event.clientX + ietruebody().scrollLeft;
				var curY = (ns6) ? e.pageY : event.clientY + ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
				var winwidth = ie && !window.opera ? ietruebody().clientWidth : window.innerWidth - 20
				var winheight = ie && !window.opera ? ietruebody().clientHeight : window.innerHeight - 20

				var rightedge = ie && !window.opera ? winwidth - event.clientX - offsetfromcursorX : winwidth - e.clientX - offsetfromcursorX
				var bottomedge = ie && !window.opera ? winheight - event.clientY - offsetfromcursorY : winheight - e.clientY - offsetfromcursorY

				var leftedge = (offsetfromcursorX < 0) ? offsetfromcursorX * (-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
				if (rightedge < tipobj.offsetWidth) {
//move the horizontal position of the menu to the left by it's width
					tipobj.style.left = curX - tipobj.offsetWidth + "px"
					nondefaultpos = true
				}
				else if (curX < leftedge)
					tipobj.style.left = "5px"
				else {
//position the horizontal position of the menu where the mouse is positioned
					tipobj.style.left = curX + offsetfromcursorX - offsetdivfrompointerX + "px"
					pointerobj.style.left = curX + offsetfromcursorX + "px"
				}

//same concept with the vertical position
				if (bottomedge < tipobj.offsetHeight) {
					tipobj.style.top = curY - tipobj.offsetHeight - offsetfromcursorY + "px"
					nondefaultpos = true
				}
				else {
					tipobj.style.top = curY + offsetfromcursorY + offsetdivfrompointerY + "px"
					pointerobj.style.top = curY + offsetfromcursorY + "px"
				}
				tipobj.style.visibility = "visible"
				if (!nondefaultpos)
					pointerobj.style.visibility = "visible"
				else
					pointerobj.style.visibility = "hidden"
			}
		}

		function hidetooltip() {
			if (ns6 || ie) {
				enabletip = false
				tipobj.style.visibility = "hidden"
				pointerobj.style.visibility = "hidden"
				tipobj.style.left = "-1000px"
				tipobj.style.backgroundColor = ''
				tipobj.style.width = ''
			}
		}

		document.onmousemove = positiontip
	</script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="topbar">
	<div class="topbar-inner">
		<div class="container">
			<h3><?php echo CHtml::link(app()->name); ?></h3>
			<?php $this->widget('zii.widgets.CMenu',array(
				'id'=>'menu',
				'htmlOptions'=>array(
					//'class'=>'nav'
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
		</div>
	</div>
</div>

<div class="container" id="page">


	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>