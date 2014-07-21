<?php
class Pincode extends AppModel
{
	var $name = "pincode";
	var $validate=array(
						 'pin1'=>array(
											'rule'=>array('rule' => 'notempty',
															'message'=>'پين 1 نبايد خالی باشد.'
															)
										)
						);
	var $belongsTo = array("Product");
}
?>