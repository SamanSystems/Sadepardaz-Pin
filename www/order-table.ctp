<?php
echo '
		<table class="listTable" border="0">
			<tr>
				<th>شماره سفارشات مرتبط</th>
				<th>محصول</th>
				<th>دوره پرداخت</th>
			</tr>';
			
			foreach ( $orders_info as $order ) {
				echo '
					<tr>
						<td>'. $order['Order']['id'] .'</td>
						<td>'. $order['Product']['name'] .'</td>
						<td>'. (($order['Order']['monthly']>0)?$order['Order']['monthly']:'مادام العمر') .'</td>
					</tr>';
			}
		echo '</table>';
?>