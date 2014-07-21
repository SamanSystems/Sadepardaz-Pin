<?php
class Product extends AppModel
{
	var $name = "product";
	var $validate=array(
						 'price'=>array(
											'rule'=>array('rule' => 'numeric',
															'message'=>'قيمت بايد عددی بر اساس تومان باشد.'
															)
										)
						);
}
?>