<div style="direction: rtl; text-align: right; font: 12px Tahoma, Arial;">
با سلام<br>
تراکنشی به ارزش <?php echo $trans['amount'];?> تومان، توسط <?php echo htmlspecialchars($trans['name']) ;?> از طريق دروازه پرداخت زرين پال، انجام شد.<br />
<br />
مقدار تراکنش: <?php echo $trans['amount'];?> تومان <br />
نام پرداخت کننده: <?php echo htmlspecialchars($trans['name']) ;?><br />
ايميل پرداخت کننده: <?php echo htmlspecialchars($trans['email']) ;?><br />
شماره ای يو: <?php echo $trans['au'] ;?><br />
توضيحات تراکنش: <?php echo htmlspecialchars($trans['desc']) ;?><br />
تاريخ تراکنش: <?php echo $jtime->pdate("Y/n/j", $trans['date']); ?><br /><br />


<a href="https://www.zarinpal.com">ورود به زرين پال</a> - <?php	echo $html->link('ورود به سامانه پرداخت', $setting['website'].'/managers/login'); ?>

<br /><br />
----------------------------------------------------------------------------<br>
تلفن: <?php echo $setting['phonenum']; ?><br>
سايت: <?php echo $html->link($setting['name'],$setting['website']); ?>
</div>