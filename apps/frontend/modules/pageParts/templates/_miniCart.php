<?php use_stylesheet('new/mini_cart.css')?>
<?php use_javascript('mini_cart') ?>
<?php use_helper('Price') ?>
<?php //Итоговая стоимсоть товаров в корзине
      $fullSum = 0;  ?>

<div id="miniCart" class="cartPos" title="Корзина">
  <div id="cart_button" class="cart_button">
    <span id="cart_items_count" class="cart_items_count"><?php echo $cart_items_count ?></span>
  </div>
  <div id="mmCart" class="mini_cart">
    <div class="mmCartTitle"><b>Ваша корзина</b></div>
    <div id="cart_content" class="mmCartContent">
   <?php //Если в корзине пусто - выводим сообщение: ?>
    <?php if($companies_count == 0): ?>
      <div id="cart_empty">Ваша корзина пуста</div>
      </div>
    <?php else: ?>
    <?php //Выводим корзину: ?>

      <?php //Так как объект корзины сгруппирован по компаниям читаем:
            foreach ($companies as $company): ?>

      <?php //Вытаскиваем сами позиции корзины?>
      <?php foreach($company->getSCart() as $cartItem): ?>
          <div id="mini_cart_item<?php echo $cartItem->getId() ?>" class="mini_cart_item">
		  	<div class="mini_cart_item_name">
		      <a id="show_item" title="<?php echo $cartItem->getSItemVariant() ?>" href="<?php echo url_for('item_info',$cartItem->getSItemVariant()->getSItem()) ?>"><?php echo $cartItem->getSItemVariant() ?></a>
		  	</div>
		  	<div class="mini_cart_item_count">
              <?php echo $cartItem->getCount().' шт.' ?>
          	</div>
		  	<div class="mini_cart_item_price">
              <?php echo price($cartItem->getPrice()) ?>
          	</div>
          	<div class="mini_cart_item_delete">
              <?php echo jq_link_to_remote(image_tag('icons/delete_16x16.png', array('alt' => 'X', 'title' => 'Удалить', 'size' => '12x12')),
                                           array(
                                           'url'      => '@cart_delete?id='.$cartItem->getId(),
                                           'method'   => 'GET',
                                           'dataType' => 'json',
                                           'csrf'     => true,
                                           'before'   => '$("#cart_items_count").html(loader);',
                                           'success'  => 'delete_cart_item('.$cartItem->getId().',data)',
                                       	   'error'	  => 'error_message()'
                                           ),
                                           array(
                            			   'href'  => url_for('cart_delete',$cartItem)
                                           )
              )?>
            </div>
            <div id="mini_cart_item_sum" class="hide"><?php echo $cartItem->getSum() ?></div>
          </div>
    <?php $fullSum += $cartItem->getSum(); ?>
    <?php endforeach; ?>

  <?php endforeach; ?>
    </div>
  <?php endif; ?>
  	<h3 id="mini_cart_full_sum" class="mini_cart_full_sum" <?php if($companies_count == 0) echo 'style="display:none;"'?>>Сумма заказа: <?php echo price($fullSum,false,true,'span') ?></h3>
    <div id="cart_actions" <?php if($companies_count == 0) echo 'class="hide"'?>>
      <?php echo link_to(image_tag('privateArea/show_order_button.png',array('alt_title' => 'Оформить заказ')),
                                'private_area')?>
      <?php echo jq_link_to_remote('Очистить корзину',
                                   array(
                                   'url'      => '@cart_clean',
                                   'method'   => 'GET',
                                   'dataType' => 'json',
                                   'csrf'     => true,
                                   'before'   => '$("#cart_items_count").html(loader);',
                                   'success'  => 'clean_cart(data)',
                                   'error'	  => 'error_message()'
                                   ),
                                   array(
                            	   'href'  => url_for('@cart_clean'),
                                   'style' => 'float: right;'
                                   )
      ) ?>
    </div>
</div>
</div>