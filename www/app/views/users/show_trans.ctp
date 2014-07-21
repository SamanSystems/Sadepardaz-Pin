<?php

if(empty($trans_info)){
?>
	<div class=content_title>
		<h2>پيگيری سرور اختصاصی مجازی خريداری شده</h2>
	</div>
	<div class="content_content">
		<?php
		echo $form->create('Onlinetran', array('url' => array('controller' => 'users' ,'action' => 'status_check')))
			.$form->input('code', array('class' => 'input-eng'))
			.$form->input('email', array('class' => 'input-eng'))
			.$form->end(__('Submit', true));
		?>
	</div>
<?php
}
else{
?>
		<h2>اطلاعات سرور اختصاصی مجازی خريداری شده</h2>
				<div class="container">
					<?php
						echo '<div class="text">'.$form->label("code").'<span dir="ltr">'.$trans_info['Onlinetran']['id'].'</span></div>'.
							'<div class="text">'.$form->label("name").$trans_info['Onlinetran']['name'].'</div>'.
							'<div class="text">'.$form->label("email").$trans_info['Onlinetran']['email'].'</div>'.
							'<div class="text">'.$form->label("mobile_tel").$trans_info['Onlinetran']['mobile_tel'].'</div>';
							
						if($pin['Pincode']['status'] == 1){
							echo '<div class="text">'.$form->label("pin1").base64_decode($pin['Pincode']['pin1']).'</div>';
							
							if(!empty($pin['Pincode']['pin2']))
								echo '<div class="text">'.$form->label("pin2").base64_decode($pin['Pincode']['pin2']).'</div>';
						}
						elseif(empty($pin['Pincode']['status'])){
							echo '<div class="text">'.$form->label("pin1").'در حال حاضر، هيچ پينی از اين نوع، موجود نيست.</div>';
						}
						else{
							echo '<div class="text">'.$form->label("pin1").'اطلاعات اين پين، به دليل تغيير وضعيت، قابل نمايش نميباشد.</div>';
						}
						
						echo '<div class="text">'.$form->label("amount").$trans_info['Onlinetran']['amount'].'</div>'.
							'<div class="text">'.$form->label("date").$jtime->pdate("Y/n/j", $trans_info['Onlinetran']['date']).'</div>'.
							'<div class="text">'.$form->label("status");	 
							switch ($pin['Pincode']['status']){
								case '-1':
								echo 'توقيف شده توسط مديريت';
								break;
								case '0':
								echo 'استفاده نشده';
								break;	
								case '1':
								echo 'نمايش داده شده - '.$html->link('عدم نمايش مجدد', array('controller' => 'users', 'action' => 'lock_pin' ,base64_encode($trans_info['Onlinetran']['email']) ,$trans_info['Onlinetran']['id']),array('escape'=>false,'title' => 'عدم نمايش مجدد پين کد'),'آيا نسبت به تغيير وضعيت، اطمينان داريد ؟');
								break;	
								case '2':
								echo 'محافظت شده توسط خودم';
								break;
								default:
								echo 'ای پی موجود نميباشد';
							}
							echo '</div><br /><br />';
							
					?>
				</div>
				<div class="bottom"></div>
<?php
}
?>