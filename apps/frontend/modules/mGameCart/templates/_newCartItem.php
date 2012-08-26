<?php foreach ($cartItems as $cartItem): ?>
<?php //Итоговая стоимсоть товаров в корзине
            $fullSum = 0;  ?>
<div id="mini_cart_item<?php echo $cartItem->getId() ?>" class="mini_cart_item">
  <a id="show_item" title="<?php echo $cartItem->getSItemVariant() ?>" href="<?php echo url_for('company/'.$cartItem->getCompany()->getUrl()) ?>"><?php echo $cartItem->getSItemVariant() ?></a>
  <?php echo link_to(image_tag('icons/delete_16x16.png', array('alt' => 'X', 'title' => 'Удалить', 'size' => '12x12')),
                                       'cart_delete', $cartItem,
                                        array('onClick' => 'delete_cart_item("'.$cartItem->getId().'","'.$secret_value.'",this); return false;')) ?><br />
</div>
<?php $fullSum += $cartItem->getSum();?>
<?php endforeach;?>
<h3 class="bold" style="color: #005388;">Сумма заказа: <?php echo $fullSum ?> руб. </h3>