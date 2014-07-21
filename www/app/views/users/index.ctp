<?php

echo '
		
		<div>'.
			$form->create('Onlinetran',array('url' => array('controller'=>'users', 'action' =>'index'))).
			$form->input('name').
			$form->input('email');
			if($products){
				echo '<div class="input" id="price_label"></div>';
				echo $form->input('product',array('options' =>$products));
			}
			elseif($product){
				echo '<div class="input text">'.$form->label('price').$product['Product']['price'].' (تومان)</div>';
				echo '<div class="input text">'.$form->label('product').$product['Product']['name'].'</div>';
				echo $form->input('product',array('type' => 'hidden','value'=> $product['Product']['id']));
			}
			echo $form->input('desc',array('label' => 'شماره تماس: ')).
			$form->end(__("Add Fund",true)).	
		'</div>';
?>