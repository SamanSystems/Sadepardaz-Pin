<div class="content_title">
	<h2>کارت شارژها (پين کدها)</h2>
</div>
<div class="content_content">
	<table border="0" class="listTable">
		<tr>
			<th>شماره</th>
			<th>محصول</th>
			<th>تاريخ افزودن</th>
			<th>وضعيت</th>
			<th>عمليات</th>
		</tr>
		<?php foreach ( $pincodes as $row ) { ?>
		<tr>
			<td><?php echo $row['Pincode']['id']; ?></td>
			<td><?php echo $row['Product']['name']; ?></td>
			<td><?php echo $jtime->pdate("Y/n/j", $row['Pincode']['add_date']); ?></td>
			<td><?php   switch($row['Pincode']['status']){
							case -1:
								echo 'قفل شده توسط مدير';
							break;
							case 0:
								echo 'استفاده نشده';
							break;
							case 1:
								echo 'استفاده شده';
							break;
							case 2:
								echo 'قفل شده توسط مشتری';
							break;
						}
			?></td>
			<td><?php echo $html->link('ويرايش', array('controller' => 'managers', 'action' => 'edit_pincode' ,$row['Pincode']['id'])).' - '.$html->link('حذف', array('controller' => 'managers', 'action' => 'delete_pincode' , $row['Pincode']['id']), array(), 'آيا ميخواهيد اين پين کد، حذف گردد؟'); ?></td>
		</tr>
		<?php } ?>
	</table>
	<p align="left"><?php echo $html->link('افزودن پين کد', array('controller'=>'managers','action'=>'add_pincode'),array('class'=>'button')); ?></p>
</div>

