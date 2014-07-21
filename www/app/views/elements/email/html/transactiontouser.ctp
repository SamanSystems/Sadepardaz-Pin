<div style="direction: rtl; text-align: right; font: 12px Tahoma, Arial;">
با سلام <?php echo $trans['name'] ;?><br>
به اطلاع شما ميرساند تراکنشی با ايميل شما در وبسايت <?php echo htmlspecialchars($setting['name']); ?> انجام شده است.<br />
<br />
مقدار تراکنش: <?php echo $trans['amount'];?> تومان <br />
نام پرداخت کننده: <?php echo htmlspecialchars($trans['name']) ;?><br />
ايميل پرداخت کننده: <?php echo htmlspecialchars($trans['email']) ;?><br />
شماره ای يو: <?php echo $trans['au'] ;?><br />
توضيحات تراکنش: <?php echo htmlspecialchars($trans['desc']) ;?><br />
تاريخ تراکنش: <?php echo $jtime->pdate("Y/n/j", $trans['date']); ?><br /><br />


برای ورود به زرين پال، <a href="https://www.zarinpal.com">اينجا کليک کنيد</a>.

<br /><br />
----------------------------------------------------------------------------<br>
تلفن: <?php echo $setting['phonenum']; ?><br>
سايت: <?php echo $html->link($setting['name'],$setting['website']); ?>
</div>