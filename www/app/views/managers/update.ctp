<?php

echo '<div class="content_title">
		<h2>مشخصات حساب من</h2>
	  </div>
		
		<div class="content_content">'
		.	$form->create('User',array('url' => array('controller'=>'managers', 'action' =>'update'))).
			$form->input("name").
			$form->input("email").
			$form->end(__("update profile",true)).
		'</div>';

?>