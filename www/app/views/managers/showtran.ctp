<?php
echo '
		<h2>مشاهده تراکنش '.$transaction['Onlinetran']['id'].'</h2>

		<div class="content_content">
		<div class="input text"><label for="Transaction">شماره تراکنش</label>'.$transaction['Onlinetran']['id'].'</div>
		<div class="input text"><label for="Transaction">ای يو تراکنش</label>'.$transaction['Onlinetran']['au'].'</div>
		<div class="input text"><label for="Transaction">مبلغ تراکنش</label>'.$transaction['Onlinetran']['amount'].' تومان</div>
		<div class="input text"><label for="Transaction">تاريخ تراکنش</label>'.$jtime->pdate("Y/n/j - h:i a", $transaction['Onlinetran']['date']).'</div>
		<div class="input text"><label for="Transaction">نام پرداخت کننده</label>'.htmlspecialchars($transaction['Onlinetran']['name']).'</div>
		<div class="input text"><label for="Transaction">ايميل پرداخت کننده</label>'.htmlspecialchars($transaction['Onlinetran']['email']).'</div>
		<div class="input text"><label for="Transaction">وضعيت تراکنش</label>';
		switch($transaction['Onlinetran']['status']){
			case 0:
				echo 'موفق';
			break;
			case -1:
				echo 'ناموفق';
			break;
			case 0:
				echo 'در حال انجام';
			break;
		}
		echo '</div>
				<div class="input text"><label for="Transaction">توضيحات تراکنش</label>'.htmlspecialchars($transaction['Onlinetran']['desc']).'</div>';
	echo '</div>';
?>