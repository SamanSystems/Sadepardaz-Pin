<div class="content_title">
	<h2>افزودن پين کد</h2>
</div>
<div class="content_content">
	<?php
	echo $form->create('Pincode', array('url' =>array('controller' => 'managers' ,'action' => 'add_pincode')))
		.$form->input('product_id',array('options' =>$products))
		.$form->input('pin1')
		.$form->input('pin2')
		.$form->input('status', array('options' => array('-1' => 'توقيف توسط مديريت','0' => 'استفاده نشده','1' => 'نمايش داده شده', '2' => 'توقيف توسط کاربر')))
		.$form->end(__('Submit', true));
	?>
</div>

