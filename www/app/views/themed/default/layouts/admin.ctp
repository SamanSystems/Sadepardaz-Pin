<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
		echo $html->meta('icon')."\n".
		$html->charset()."\n".
		$html->css('style.css')."\n".
		$javascript->link(array('jquery','functions','pngfix','tiny_mce/tiny_mce'))."\n".
		$scripts_for_layout;
?>
<script type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "editor",
		theme : "advanced",
		skin : "o2k7",
		plugins : "safari,table,advimage,advlink,emotions,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,inlinepopups,falang",
		theme_advanced_buttons1 : "faen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,code",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,|,ltr,rtl,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		directionality : "rtl",
		theme_advanced_statusbar_location : "bottom",
		force_br_newlines: true,
		forced_root_block: "",
		convert_urls : false,
		verify_html : false
	});
</script>
<title>مديريت سامانه پرداخت زرين پال <?php echo $title_for_layout; ?></title>
</head>
<body>

<div class="wrapper">
	

	<div class="top_corners"></div>
	
	<div class="main">
		
		<div class="right">
			<?php
				echo $this->element('admin-menu', array('cache' => '+1 month'));
			?>
		</div>
		
		<div class="left">
			<div class="content">
				<?php 
				if ( $session->check('Message.flash') ) $session->flash();
				echo $content_for_layout; ?>
			</div>
		</div>
		
		<div class="clear"></div>
		
	</div>
	<div class="clear"></div>
	<div class="footer">
		<p>اين صفحه توسط <a href="https://www.zarinpal.com/pages/labs/index/">آزمايشگاه زرين پال</a> توسعه داده شده است.
	</p>
	</div>
	
	<div class="bottom_corners"></div>
	
</div>

</body>
</html>
