<?php
class ZarinpalComponent extends Object 
{
	private $site;
	private $amount;
	private $user_id;
	private $pin = '';
	
	function ZarinpalComponent(){
		$this->client = new SoapClient('http://www.zarinpal.com/WebserviceGateway/wsdl', array('encoding'=>'UTF-8'));
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
		$this->data['Onlinetran']['product_id'] = $data['product'];
		
		$this->Onlinetransaction->create();
		$this->Onlinetransaction->save($this->data);

		$res = $this->client->PaymentRequest($this->pin, $amount, $this->callBackUrl, urlencode('افزايش اعتبار: '.$data['name'].' تراکنش شماره: '.$this->Onlinetransaction->id.' توضيحات: '.$data['desc']) );
		
		$this->data['Onlinetran']['au'] = $res;
		$this->Onlinetransaction->save($this->data);
		
		if ( !empty($res) )
		 return array('address' => "https://www.zarinpal.com/users/pay_invoice/" .$res);
	}
  
	function Verify($data)
	{
		$transaction = $this->Onlinetransaction->find('first', array('conditions' => array('au' => $data['au'])));
		$res = $this->client->PaymentVerification($this->pin, $data['au'] , $transaction['Onlinetran']['amount']);

		if($res == 1)
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