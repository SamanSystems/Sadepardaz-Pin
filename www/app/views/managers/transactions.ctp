<div class="content_title">
	<h2>تراکنش ها</h2>
</div>
<div class="content_content">
	<br /><br />
	<table border="0" class="listTable">
		<tr>
			<th>نام</th>
			<th><?php echo $paginator->sort('مبلغ', 'Onlinetran.amount'); ?></th>
			<th><?php echo $paginator->sort('تاریخ', 'Onlinetran.date'); ?></th>
			<th><?php echo $paginator->sort('وضعیت', 'Onlinetran.status'); ?></th>
			<th>انتخاب ها</th>
		</tr>
		<?php foreach ( $transactions as $row ) { ?>
		<tr>
			<td><?php echo htmlspecialchars($row['Onlinetran']['name']); ?></td>
			<td><?php echo $row['Onlinetran']['amount']; ?></td>
			<td><?php echo $jtime->pdate("Y/n/j", $row['Onlinetran']['date']); ?></td>
			<td><?php 
						switch($row['Onlinetran']['status']){
							case 1:
								echo 'موفق';
							break;
							case 0:
								echo 'در حال انجام';
							break;
							case -1:
								echo 'ناموفق';
							break;
						}
				?></td>
			<td><?php
				echo $html->link('مشاهده', array('controller' => 'managers', 'action' => 'showtran' ,$row['Onlinetran']['id']));
				?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<div align="center" class="paginate">
	<?php

		echo $paginator->prev('«قبلي   ', null, null, array('class' => 'disabled')).
			$paginator->next(' بعدي »', null, null, array('class' => 'disabled'));
	?>
	</div>
</div>

