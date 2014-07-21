<div class="block">
				<div class="block_title">
					<h2>منوی مديريت</h2>
				</div>
				<div class="block_content">
				<center>
				<?php
					if(!empty($user))
						echo $html->link('صفحه اصلی مديريت', array('controller' => 'managers', 'action' => 'index')).'<br /><br />'
							.$html->link('محصولات',array('controller' => 'managers', 'action' => 'products')).'<br /><br />'
							.$html->link('تراکنش های موفق', array('controller' => 'managers', 'action' => 'transactions','success')).'<br />'
							.$html->link('تراکنش های در حال انجام', array('controller' => 'managers', 'action' => 'transactions','inproces')).'<br />'
							.$html->link('تراکنش های ناموفق', array('controller' => 'managers', 'action' => 'transactions','notconfirm')).'<br />'
							.$html->link('ساير تراکنش ها', array('controller' => 'managers', 'action' => 'transactions','all')).'<br /><br />'
							.$html->link('تغيير اطلاعات کاربری',array('controller' => 'managers', 'action' => 'update')).'<br />'
							.$html->link('تغيير کلمه عبور',array('controller' => 'managers', 'action' => 'change_password')).'<br />'
							.$html->link('تنظيمات سامانه پرداخت',array('controller'=>'managers' ,'action'=>'edit_setting')).'<br /><br />'
							.$html->link('خروج از سامانه',array('controller'=>'managers' ,'action'=>'logout'));
					else
						echo $html->link('ورود به سيستم', array('controller' => 'managers', 'action' => 'login')).'<br />'
							.$html->link('فراموشی رمز عبور',array('controller' => 'managers', 'action' => 'forget_password')).'<br />';

				
				?>
				</center>
				</div>
			</div>