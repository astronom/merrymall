<table class="cart_list" border="0" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <th>Номер заказа</th>
      <th>Состав</th>
      <th>Адресс доставки</th>
    </tr>
  </thead>
  <tbody>
<?php $curentOrder = 0; ?>
<?php foreach ($ordersList as $order):?>
  <tr class="cart_item">
   <td><?php if($curentOrder != $order->getOrderId()):?>
         <?php echo link_to($order->getOrderId(), 'order_info', array('order_id' => $order->getOrderId()))?>
   	   <?php endif; ?>
   </td>
   <td><?php echo $order->getSItemVariant()?></td>
   <td><?php echo $order->getSOrder()->getAddress()?></td>
  </tr>
  <?php $curentOrder = $order->getOrderId(); ?>
<?php endforeach;?>
  </tbody>
  <tfoot>
  </tfoot>
</table>