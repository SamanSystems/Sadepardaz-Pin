<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
		echo $html->meta('icon')."\n".
		$html->charset()."\n".
		$html->css('style.css')."\n".
		$html->meta('keywords', 'پرداخت آنلاين', array(), false).
		$html->meta('description', 'صفحه پرداخت آنلاين با همکاری زرين پال' , array(), false).
		$scripts_for_layout;
?>
<title>سامانه پرداخت زرين پال <?php echo $title_for_layout; ?></title>
</head>
<body>

<div class="wrapper">
	
	<div class="top_corners"></div>
	
	<div class="main">
		
		<div class="right">
			<?php
				echo $this->element('merchants', array('cache' => '+1 month'));
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