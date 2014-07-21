<?php

class ManagersController extends AppController
{
	//--- Variables
	var $uses = array('User', 'Onlinetran', 'Pincode', 'Product', 'Setting');
	var $components = array('Jtime', 'Email', 'Session', 'Auth');
	var $helpers = array('Html', 'Form', 'Session', 'Javascript', 'Paginator', 'Xml', 'Qoute');
	var $paginate = array('limit' => 15);
	var $setting;
	
    function beforeFilter ()
    {
		$this -> setting = $this->Setting->find();
		$this -> setting = $this->setting['Setting'];
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);
		$this->Auth->loginAction = array('controller'=>'managers' , 'action'=> 'login');
		$this->Auth->loginRedirect = array('controller' => 'managers', 'action' => 'index');
		$this->Auth->logoutRedirect =  '/managers/login';
		$this->Auth->loginError="نام کاربری یا رمز عبور اشتباه است";
		$this->Auth->authError="شما اجازه دسترسی به این بخش را ندارید";
	    $this->set('user',$this->Auth->user());
		$this->Auth->allow('login','forget_password');
		$this->layout = 'admin';
    }
	
	function beforeRender()
	{
		parent::beforeRender();
		$this->pageTitle = '- '. __('Management Panel',true);
	}
	
    function login()
    {
	
    }

    function logout()
    {
		$this->redirect($this->Auth->logout());
    }
	
	function forget_password($step = NULL,$email = NULL, $key = NULL)
	{
		if($step == 'step2'){
			$email_decode = base64_decode($email);
			$user = $this->User->findByEmail($email_decode);
			$org_key=$user['User']['password'].'webservicesmallpay';
			$org_key=md5($org_key);
			$org_key=substr($org_key,2,12);
			
			if($org_key == $key){
				if ( $this->data )
				{
					if ( $this->data['User']['password'] == $this->data['User']['password_confirm'] )
					{
						$this->User->id = $user['User']['id'];
						$data['User']['password'] = $this->Auth->password($this->data['User']['password']);
						if($this->User->save($data)){
							$this->Session->setFlash('رمز عبور با موفقیت تغییر یافت', 'default', array('class' => 'success-msg'));
							
							$this->set('setting',$this->setting);
							$this->set('user',$user);
							$this->set('password',$this->data['User']['password']);
							$this->Email->to = $user['User']['email'];
							$this->Email->from = $this -> setting['mail_title'].' <'.$this -> setting['mail_address'].'>'  ;
							$this->Email->subject = 'بازیابی رمز عبور';
							$this->Email->template = 'forget_password_2';
							$this->Email->sendAs = 'html';
							$this->Email->send();
							unset($this->data);
							$this->redirect('/managers/login/');
						}
					}
					else
					{
						$this->Session->setFlash('رمز عبور شما با تکرار آن مطابقت ندارد', 'default', array('class' => 'error-msg'));
						$this->redirect('/managers/forget_password/step2/'.$email.'/'.$key.'/');
					}
				}
				else{
					$this->set('key',$key);
					$this->set('email', $email);
					$this->set('step', $step);
				}
			}
			else{
				$this->Session->setFlash('لينک وارد شده صحيح نيست.', 'default', array('class' => 'error-msg'));
				$this->redirect('/managers/login/');
			}
		}
		elseif ( $this->data )
		{
			if ( $user = $this->User->findByEmail($this->data['User']['email']) )
			{
				$key=$user['User']['password'].'webservicesmallpay';
				$key=md5($key);
				$key=substr($key,2,12);
				$this->set('user',$user);
				$this->set('key',$key);
				$this->set('setting',$this->setting);					
				$this->Email->to = $user['User']['email'] ;
				$this->Email->from = $this -> setting['mail_title'].' <'.$this -> setting['mail_address'].'>';
				$this->Email->subject = ' درخواست تغيير رمز در'.$this->setting['name'];
				$this->Email->template = 'forget_password';
				$this->Email->sendAs = 'html';
				$this->Email->send();
				$this->Session->setFlash('به منظور تکميل عمليات ايميلی برای شما ارسال شد.', 'default', array('class' => 'success-msg'));
				$this->redirect('/managers/login/');
			}
			else
			{
				$this->Session->setFlash('کاربری با این مشخصات یافت نشد', 'default', array('class' => 'error-msg'));
			}
		}
	}	

	function index()
	{
		$today = $this->Jtime->pmktime(0,0,0,$this->Jtime->pdate('m'),$this->Jtime->pdate('j'),$this->Jtime->pdate('Y'));
		$total_today_insystem = $this->Onlinetran->find('first', array( 'conditions' => array('Onlinetran.status' => 1, 'Onlinetran.date >=' => $today),
												'fields' => array('SUM(Onlinetran.amount) as tot', 'COUNT(*) as count_tot')
											 )
								);
		$total_yesterday_insystem = $this->Onlinetran->find('first', array( 'conditions' => array('Onlinetran.status' => 1, 'Onlinetran.date between ? AND ?' => array($today-86400,$today)),
												'fields' => array('SUM(Onlinetran.amount) as tot', 'COUNT(*) as count_tot')
											 )
								);
		$total_all_insystem = $this->Onlinetran->find('first', array( 'conditions' => array('Onlinetran.status' => 1),
												'fields' => array('SUM(Onlinetran.amount) as tot', 'COUNT(*) as count_tot')
											 )
								);
		$total_all_inproces = $this->Onlinetran->find('first', array( 'conditions' => array('Onlinetran.status' => 0),
												'fields' => array('SUM(Onlinetran.amount) as tot', 'COUNT(*) as count_tot')
											 )
								);
		$total_all_notconfirm = $this->Onlinetran->find('first', array( 'conditions' => array('Onlinetran.status' => -1),
												'fields' => array('SUM(Onlinetran.amount) as tot', 'COUNT(*) as count_tot')
											 )
								);
		$this->set('total', array(
				   'today' => $total_today_insystem[0]['tot'], 
				   'yesterday' => $total_yesterday_insystem[0]['tot'],
                   'all' => $total_all_insystem[0]['tot'],
				   'today_count'=> $total_today_insystem[0]['count_tot'],
                   'yesterday_count'=> $total_yesterday_insystem[0]['count_tot'],
                   'all_count'=> $total_all_insystem[0]['count_tot'],
				   'inproces'=> $total_all_inproces[0]['tot'],
				   'inproces_count'=> $total_all_inproces[0]['count_tot'],
				   'notconfirm'=> $total_all_notconfirm[0]['tot'],
				   'notconfirm_count'=> $total_all_notconfirm[0]['count_tot'])
				);
		$this->set('today',$today);
					
	}
	function transactions ($operation = null, $date = null)
	{
		$this->paginate=array('limit' => 15, 'order' => 'Onlinetran.id DESC');
		if(empty($date)){
			switch($operation){
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => 1)));
				break;
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => 0)));
				break;
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => -1)));
				break;
				default:
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0)));
			}
		}
		else{
			switch($operation){
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => 1,'Onlinetran.date between ? AND ?' => array($date-86400,$date))));
				break;
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => 0,'Onlinetran.date between ? AND ?' => array($date-86400,$date))));
				break;
				case 'success':
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.status' => -1,'Onlinetran.date between ? AND ?' => array($date-86400,$date))));
				break;
				default:
					$this->set('transactions', $this->paginate('Onlinetran',array('Onlinetran.amount >' => 0,'Onlinetran.date between ? AND ?' => array($date-86400,$date))));
			}
		}
	}
	function edit_transaction ($id = null)
	{
		if ( $id )
		{
			$this->Onlinetran->id = $id;
			if ( $this->data )
			{
				if ( $this->Onlinetran->save($this->data) )
				{
					$this->Session->setFlash('اطلاعات با موفقیت ثبت شد', 'default', array('class' => 'success-msg'));
				}
				else
				{
					$this->Session->setFlash('مشکلی در ثبت اطلاعات وجود دارد', 'default', array('class' => 'error-msg'));
				}
			}
			$this->data = $this->Onlinetran->read();
		}
	}
	
	function edit_setting()
	{
		if($this->data)
		{
			$this->Setting->id=$this->Setting->find('id');
			$this->Setting->save($this->data);
			$this->Session->setFlash('تنظیمات با موفقیت ذخیره شد', 'default', array('class' => 'success-msg'));
			$this->redirect('/managers') ;
		}else
		{
			$this->data=$this->Setting->find();
		}
	}
	function change_password()
	{
		if ( $this->data )
		{
			$user_password = $this->User->find('count',array('conditions'=>array('User.id'=>$this->Auth->user('id'),'User.password'=> $this->Auth->password($this->data['User']['old_password']))));
			if($user_password){
				$this->User->id = $this->Auth->user('id');
				if ( $this->data['User']['password'] == $this->data['User']['password_confirm'] )
				{
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
					if($this->User->save($this->data)){
						$this->Session->setFlash('رمز عبور با موفقیت تغییر یافت', 'default', array('class' => 'success-msg'));
						$this->redirect(array('controller' => 'managers', 'action' => 'index'));
					}
					unset($this->data['User']);
				}
				else
				{
					$this->Session->setFlash('رمز عبور شما با تکرار آن مطابقت ندارد', 'default', array('class' => 'error-msg'));
				}
			}
			else{
				$this->Session->setFlash('رمز عبور فعلی اشتباه است', 'default', array('class' => 'error-msg'));
			}
		}
	}
	function update()
	{
			$this->User->id=$this->Auth->user('id');
			if(empty($this->data)){
				$this->data=$this->User->read();
			}else {
			if($this->User->save($this->data))
				{			
					$this->Session->setFlash(__('Your information has been updated',true), 'default', array('class' => 'success-msg'));
				}	
			}
		
	}
	function showtran($id)
	{
		$transaction=$this->Onlinetran->findById($id);
		$this ->set('transaction', $transaction);
	}
	function products()
	{
		$products=$this->Product->find('all',array('order' => array('Product.publish_order ASC') ,'fields'=>array('id','name','price','publish')));
		$this->set('products',$products);
	}
	function add_product()
	{
		if($this->data){
			$this->Product->create();
			if($this->Product->save($this->data)){
				$this->Session->setFlash('ممحصول با موفقيت ثبت شد.', 'default', array('class' => 'success-msg'));
				$this->redirect(array('controller' => 'managers', 'action' => 'products'));
			}
			else{
				$this->Session->setFlash('مشکلی در ثبت محصول وجود دارد.', 'default', array('class' => 'error-msg'));
			}
		}
	}
	function edit_product($id = null)
	{
		$this->Product->id = $id;
		if($this->data){
			if($this->Product->save($this->data)){
				$this->Session->setFlash('محصول با موفقيت ويرايش يافت.', 'default', array('class' => 'success-msg'));
				$this->redirect(array('controller' => 'managers', 'action' => 'products'));
			}
			else{
				$this->Session->setFlash('مشکلی در ويرايش محصول وجود دارد.', 'default', array('class' => 'error-msg'));
			}
		}else{
			$this->data=$this->Product->read();
		}
	}
	function delete_product($id = null)
	{
		$this->Product->id = $id;
		if($this->Product->del()){
			$this->Session->setFlash('محصول با موفقيت ويرايش يافت.', 'default', array('class' => 'success-msg'));
		}else{
			$this->Session->setFlash('محصول مورد نظر يافت نشد.', 'default', array('class' => 'error-msg'));
		}
		$this->redirect(array('controller' => 'managers', 'action' => 'products'));
	}
	function add_pincode()
	{
		if($this->data){
			$this->data['Pincode']['pin1'] = base64_encode($this->data['Pincode']['pin1']);
			$this->data['Pincode']['pin2'] = base64_encode($this->data['Pincode']['pin2']);
			$this->data['Pincode']['add_date'] = time();
			$this->Pincode->create();
			if($this->Pincode->save($this->data)){
				$this->Session->setFlash('پين کد با موفقيت ثبت شد.', 'default', array('class' => 'success-msg'));
				$this->redirect(array('controller' => 'managers', 'action' => 'pincodes'));
			}
			else{
				$this->Session->setFlash('مشکلی در ثبت محصول وجود دارد.', 'default', array('class' => 'error-msg'));
			}
		}
		$products=$this->Product->find('list',array('fields'=>array('id','name')));
		$this->set('products',$products);
		$this->data['Pincode']['status'] = 0;
	}
	function edit_pincode($id = null)
	{
		$this->Pincode->id = $id;
		if($this->data){
			$this->data['Pincode']['pin1'] = base64_encode($this->data['Pincode']['pin1']);
			$this->data['Pincode']['pin2'] = base64_encode($this->data['Pincode']['pin2']);
			if($this->Pincode->save($this->data)){
				$this->Session->setFlash('پين کد ويرايش يافت.', 'default', array('class' => 'success-msg'));
				$this->redirect(array('controller' => 'managers', 'action' => 'pincodes'));
			}
			else{
				$this->Session->setFlash('مشکلی در ويرايش پين کد وجود دارد.', 'default', array('class' => 'error-msg'));
			}
		}else{
			$products=$this->Product->find('list',array('fields'=>array('id','name')));
			$this->set('products',$products);
			$pincode=$this->Pincode->read();
			$pincode['Pincode']['pin1'] = base64_decode($pincode['Pincode']['pin1']);
			$pincode['Pincode']['pin2'] = base64_decode($pincode['Pincode']['pin2']);
			$this->data= $pincode;
		}
	}
	function delete_pincode($id = null)
	{
		$this->Pincode->id = $id;
		if($this->Pincode->del()){
			$this->Session->setFlash('پين کد حذف شد.', 'default', array('class' => 'success-msg'));
		}else{
			$this->Session->setFlash('پين کد مورد نظر يافت نشد.', 'default', array('class' => 'error-msg'));
		}
		$this->redirect(array('controller' => 'managers', 'action' => 'pincodes'));
	}
	function pincodes()
	{
		$pincodes=$this->Pincode->find('all',array('order' => array('Pincode.id ASC')));
		$this->set('pincodes',$pincodes);
	}
}
?>