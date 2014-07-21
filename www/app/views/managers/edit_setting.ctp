<div class="content_title">
	<h2>ویرایش  تنظیمات</h2>
</div>
<div class="content_content">
	<?php
	echo $form->create('Setting', array('url' => array('controller' => 'managers' ,'action' => 'edit_setting')))
		.$form->input('name',array('label'=>'نام شرکت:'))
		.$form->input('phonenum',array('label'=>'تلفن تماس:'))
		.$form->input('address',array('label'=>'آدرس شرکت:'))
		.$form->input('website',array('آدرس سایت : '))
		.$form->input('desc',array('label'=>'توضیحات:'))
		.$form->input('mail_address',array('label'=>'آدرس پست الکترونیک:','class'=>'input-eng'))
		.$form->input('mail_title',array('label'=>'عنوان پست‌های الکترونیک:'))
		.$form->input('send_email',array('label'=>'پست الکترونیک فرستاده شود'))
		.$form->input('pin',array('label'=>'کد فعال سازی دروازه پرداخت'))
		.$form->end(__('Submit', true));
	?>
</div>

