<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none;" border="0">
<tr>
	<td width="100%" colspan="3" height="15"><img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" />
</tr>
<tr>
<td width="15">
<img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" />
</td>
<td align="left">
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Заказ №: <?php echo $orderId ?></span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Покупатель: <strong><?php echo $userFullName ?> (конт.телефон: <?php echo $userPhone ?>)</strong></span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Адрес доставки заказа: <strong><?php echo $orderDelivery ?></strong></span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Оплата заказа осущестляется наличными</span>
  <?php foreach ($orderList as $orderItem): ?>
	<?php $countSum = 0; ?>
	<span style="font-family:Tahoma; font-size:12px; color:#404040;">
	Магазин: <?php $orderItem->sCarts[0]->getCompany()->getName()?>
	</span>
	<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none;" border="0">
		<tr>
			<td align="center"><strong>Товар</strong></td>
			<td align="center"><strong>Количчество</strong></td>
			<td align="center"><strong>Цена</strong></td>
		</tr>
		<?php foreach ($orderItem->getSCarts() as $i => $cartItem):?>
		<tr>
			<td><?php echo $cartItem->getSItemVariant() ?></td>
			<td><?php echo $cartItem->getCount() ?> шт.</td>
			<td><?php echo $cartItem->getSum()?> руб.</td>
		</tr>
		<?php $countSum += $cartItem->getSum();?>
		<?php endforeach;?>
		<tr>
			<td><strong>Сумма заказа: <?php echo $countSum; ?> руб.</strong></td>
		</tr>
	</table>
	<?php endforeach;?>
</td>
<td width="15">
<img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" />
</td>
</tr>
<tr>
	<td width="100%" colspan="3" height="15"><img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" /></td>
</tr>
</table>
