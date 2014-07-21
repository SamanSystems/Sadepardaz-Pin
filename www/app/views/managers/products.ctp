<div class="content_title">
	<h2>شاخه های خبری</h2>
</div>
<div class="content_content">
	<table border="0" class="listTable">
		<tr>
			<th>نام</th>
			<th>قيمت</th>
			<th>وضعيت</th>
			<th>انتخاب ها</th>
		</tr>
		<?php foreach ( $products as $row ) { ?>
		<tr>
			<td><?php echo $row['Product']['name']; ?></td>
			<td><?php echo $row['Product']['price']; ?></td>
			<td><?php if($row['Product']['publish'] == 1) echo 'نمايش'; else echo 'عدم نمايش'; ?></td>
			<td><?php echo $html->link('ويرايش', array('controller' => 'managers', 'action' => 'edit_product' ,$row['Product']['id'])).' - '.$html->link('حذف', array('controller' => 'managers', 'action' => 'delete_product' , $row['Product']['id']), array(), 'آيا می خواهيد اين محصول حذف گردد؟'); ?></td>
		</tr>
		<?php } ?>
	</table>
	<p align="left"><?php echo $html->link('افزودن فايل جديد', array('controller'=>'managers','action'=>'add_product'),array('class'=>'button')); ?></p>
</div>

