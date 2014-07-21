<?php

if(empty($total['today'])) $total['today'] = 0;
if(empty($total['yesterday'])) $total['yesterday'] = 0;
if(empty($total['all'])) $total['all'] = 0;
if(empty($total['today_count'])) $total['today_count'] = 0;
if(empty($total['yesterday_count'])) $total['yesterday_count'] = 0;
if(empty($total['all_count'])) $total['all_count'] = 0;
if(empty($total['inproces'])) $total['inproces'] = 0;
if(empty($total['inproces_count'])) $total['inproces_count'] = 0;
if(empty($total['notconfirm'])) $total['notconfirm'] = 0;
if(empty($total['notconfirm_count'])) $total['notconfirm_count'] = 0;

echo '<div class="content_title">
		<h2>مديريت سيستم</h2>
</div>';

echo '
<div class="content_content">
	<center>
	<table border="0" width="99%" cellpadding="5" style="border: 1px solid #dfdfdf" cellspacing="0">
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">مبلغ تراکنش های ورودی امروز</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['today'].' تومان</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">تعداد تراکنش های ورودی امروز</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['today_count'].'</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">مبلغ تراکنش های ورودی ديروز</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['yesterday'].' تومان</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">تعداد تراکنش های ورودی ديروز</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['yesterday_count'].'</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">مبلغ تراکنش های ورودی کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['all'].' تومان</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">تعداد تراکنش های ورودی کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['all_count'].'</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">مبلغ تراکنش های در حال انجام کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['inproces'].' تومان</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">تعداد تراکنش های در حال انجام کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['inproces_count'].'</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">مبلغ تراکنش های غير موفق کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['notconfirm'].' تومان</b></td>
		</tr>
		<tr>
			<td bgcolor="#e0e0e0" style="border-bottom: 1px solid #dfdfdf">تعداد تراکنش های غير موفق کل</td>
			<td style="border-bottom: 1px solid #dfdfdf"><b>'.$total['notconfirm_count'].'</b></td>
		</tr>
		
	</table>

	
	</center>
	<br /><br />
	<ul class="admin-lists">';

			echo '<li>'
				.$html->link('تراکنش های موفق', array('controller' => 'managers', 'action' => 'transactions','success')).'<br />'
				.$html->link('تراکنش های در حال انجام', array('controller' => 'managers', 'action' => 'transactions','inproces')).'<br />'
				.$html->link('تراکنش های ناموفق', array('controller' => 'managers', 'action' => 'transactions','notconfirm')).'<br />'
				.$html->link('ساير تراکنش ها', array('controller' => 'managers', 'action' => 'transactions','all')).'<br />'
			.'</li>';

			echo '<li>'
				.$html->link('تراکنش های موفق امروز', array('controller' => 'managers', 'action' => 'transactions','success',$today)).'<br />'
				.$html->link('تراکنش های موفق ديروز', array('controller' => 'managers', 'action' => 'transactions','success',$today-86400)).'<br />'
				.$html->link('تراکنش های در حال انجام امروز', array('controller' => 'managers', 'action' => 'transactions','inproces',$today)).'<br />'
				.$html->link('تراکنش های ناموفق امروز', array('controller' => 'managers', 'action' => 'transactions','notconfirm',$today)).'<br />'
			.'</li>';
			
			echo '<li>'
				.$html->link('محصولات',array('controller' => 'managers', 'action' => 'products')).'<br />'
				.$html->link('کارت شارژ ها (پين کد ها)',array('controller' => 'managers', 'action' => 'pincodes')).'<br /><br />'
				.$html->link('تغيير اطلاعات کاربری',array('controller' => 'managers', 'action' => 'update')).'<br />'
				.$html->link('تغيير کلمه عبور',array('controller' => 'managers', 'action' => 'change_password')).'<br />'
				.$html->link('تنظيمات سامانه پرداخت',array('controller'=>'managers' ,'action'=>'edit_setting')).'<br /><br />'
				.$html->link('خروج از سامانه',array('controller'=>'managers' ,'action'=>'logout'))
				.'</li>';

echo	'</ul>
</div>';
?>