<table>
<thead><tr><th>Товар</th><th>Кол.</th><th>Сумма</th></tr></thead>
<tbody>
<?php $fullSum = 0 ?>
<?php foreach($s_order->getSCarts() as $s_item):?>
<tr>
<?php echo '<td>'.$s_item->getSItemVariant().'</td><td>'.$s_item->getCount().'</td><td>'.$s_item->getSum().' руб.</td>' ?>
</tr>
<?php $fullSum += $s_item->getSum()?>
<?php endforeach;?>
</tbody>
<tfoot><tr><td colspan="3">Итого: <?php echo $fullSum ?> руб.</td></tr></tfoot>
</table>