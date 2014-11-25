<?php
class ZarinpalComponent extends Object 
{
	private $site;
	private $amount;
	private $user_id;
	private $pin = '';
	
	function ZarinpalComponent(){
		$this->client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding'=>'UTF-8'));
		$this->callBackUrl = "/users/verify_online/Zarinpal";
		$this->site = "";
		$this->Onlinetransaction = ClassRegistry::init('Onlinetran');
	
	}
	
	function SetVar($variable,$value){
		$this->{$variable} = $value;
	}
	
	function Execute ($data)
	{
		$amount = intval($data['amount']);
		$this->callBackUrl = $this->site.$this->callBackUrl;
		$this->data['Onlinetran']['status'] = 0;
		$this->data['Onlinetran']['amount'] = $amount;
		$this->data['Onlinetran']['name'] = $data['name'];
		$this->data['Onlinetran']['date'] = time();
		$this->data['Onlinetran']['email'] = $data['email'];
		$this->data['Onlinetran']['desc'] = $data['desc'];
		$this->data['Onlinetran']['tel'] = $data['tel'];
		//$this->data['Onlinetran']['pg'] = $data['pg'];
		
		$this->Onlinetransaction->create();
		$this->Onlinetransaction->save($this->data);

		$res = $this->client->PaymentRequest(
						array(
								'MerchantID' 	=> $this->pin,
								'Amount' 	=> $amount,
								'Description' 	=> 'خریدار: '.$data['name'].' شماره فاکتور: '.$this->Onlinetransaction->id.' توضیحات: '.$data['desc'],
								'Email' 	=> $Email,
								'Mobile' 	=> $Mobile,
								'CallbackURL' 	=> $this->callBackUrl
							)
	);


		//print_r($res);
		$this->data['Onlinetran']['au'] = $res->Authority;
		$this->Onlinetransaction->save($this->data);
		//print_r($data);
		if ( $res->Status == 100 )
		{
			if( $data['pg'] == 'zp')
				{ 
				return array('address' => "https://www.zarinpal.com/pg/StartPay/".$res->Authority);
			}else{
				return array('address' => "https://www.zarinpal.com/pg/StartPay/".$res->Authority."/ZarinGate");
			}
		}		
	}
  
	function Verify($data)
	{
		$transaction = $this->Onlinetransaction->find('first', array('conditions' => array('au' => $data['Authority'])));
		$res = $this->client->PaymentVerification(
						  	array(
									'MerchantID'	 => $this->pin,
									'Authority' 	 => $data['Authority'],
									'Amount'	 => $transaction['Onlinetran']['amount']
								)
		);



		if($res->Status == 100)
		{
			if($transaction['Onlinetran']['status']==0){
				$this->Onlinetransaction->id = $transaction['Onlinetran']['id'];
				$this->data['Onlinetran']['status'] = 1;
				$this->Onlinetransaction->save($this->data);
				return $transaction['Onlinetran'];
			}
			
		}else{
			$this->data['Onlinetran']['status'] = -1;
			$this->Onlinetransaction->save($this->data);
			return false;
		}
		
		
		
	}
}
?>
