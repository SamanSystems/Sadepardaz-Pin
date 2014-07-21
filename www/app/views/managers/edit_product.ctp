<div class="content_title">
	<h2>ويرايش محصول</h2>
</div>
<div class="content_content">
	<?php
	echo $form->create('Product', array('url' =>array('controller' => 'managers' ,'action' => 'edit_product')))
		.$form->input('name', array('label' => 'نام فايل'))
		.$form->input('description')
		.$form->input('price')
		.$form->input('publish_order')
		.$form->input('publish', array('label' => 'در ليست نمايش داده شود','type' => 'checkbox'))
		.$form->end(__('Submit', true));
	?>
</div>