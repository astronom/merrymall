<?php use_javascript('cart')?>
<?php if(count($companies)>0): ?>
<table class="cart_list" border="0" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <th>Наименование</th>
      <th>Количество</th>
      <th>Итого</th>
      <th>Действие</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php $fullSum = 0;?>
    <?php foreach ($companies as $company): ?>
    <tr>
      <td colspan="5" style="padding: 7px 0;">
        <a href="<?php echo url_for('company', $company) ?>">
        <?php if($company->getLogo()): ?>
          <?php echo image_tag($company->getLogo(), array('alt_title' => 'Перейти в магазин '.$company->getName(), 'size' => '100x38')) ?>
        <?php else: ?>
          <?php echo $company->getName() ?>
        <?php endif; ?>
        </a>
      </td>
    </tr>
    <?php $countSum = 0; ?>
    <?php foreach($company->getSCart() as $cartItem): ?>
    <tr id="<?php echo 'cart_item_'.$company->getId().'_'.$cartItem->getId() ?>" class="cart_item">
    <td>
      <div class="cart_image">
        <a title="<?php echo $cartItem->getSItemVariant()->getName() ?>" class="zoomin hide" href="<?php echo $cartItem->getSItemVariant()->getSItem()->sImages[0]->getImageUrl() ?>"></a>
        <a href="<?php echo url_for('item_info',$cartItem->getSItemVariant()->getSItem()) ?>" title="<?php echo $cartItem->getSItemVariant(); ?>">
          <?php echo image_tag($cartItem->getSItemVariant()->getSItem()->getThumbnailUrl(array('width'=> '60', 'height' => '60')),array('alt_title' => $cartItem->getSItemVariant())) ?>
        </a>
      </div>
      <div class="cart_description">
        <a id="" title="<?php echo $cartItem->getSItemVariant() ?>" href="<?php echo url_for('item_info',$cartItem->getSItemVariant()->getSItem()) ?>"><?php echo $cartItem->getSItemVariant() ?></a><br />
        <br/>
      </div>
    </td>
    <td class="cart_count">
      <form action="">
        <img id="minus" class="count_action" src="/images/icons/round_remove_16x16.png" alt="-" />
        <input id="<?php echo $company->getId().'_'.$cartItem->getId() ?>" name="cartForm" type="text" size="7" maxlength="2" value="<?php echo $cartItem->getCount() ?>" style="text-align: center;"/>
        <input type="hidden" value="<?php echo $cartItem->getPrice() ?>"/>
        <img id="plus" class="count_action" src="/images/icons/round_add_16x16.png" alt="-" />
      </form>
    </td>
    <td class="cart_price">
      <span class="price" title="Цена за единицы продукции - <?php echo $cartItem->getPrice()?> руб."><?php echo $cartItem->getSum()?> руб.</span>
    </td>
    <td class="cart_actions">
      <?php //echo link_to(image_tag('icons/clipboard_16x16.png', array('alt_title' => 'перенести в Wishlist',
            //                                                                 'class' => 'cart_action',
            //                                                                 'style' => 'padding-right: 20px;')),
            //            'cart_to_wishlist', $cartItem,
            //                array('onclick' => 'move_to_wishlist("'.$company->getId().'","'.$cartItem->getId().'","'.$cartItem->getItemVariantId().'","'.$secret_name.'","'.$secret_value.'"); return false;')) ?>
      <?php //echo link_to(image_tag('icons/delete_16x16.png', array('alt_title' => 'удалить',
            //                                                                 'class' => 'cart_action')),
        	//			'cart_delete', $cartItem,
            //                array('onclick' => 'delete_cart_item("'.$company->getId().'_'.$cartItem->getId().'","'.$secret_name.'","'.$secret_value.'"); return false;')) ?>
      <?php echo jq_link_to_remote(image_tag('icons/delete_16x16.png', array('alt' => 'X', 'title' => 'Удалить', 'size' => '16x16')),
                                           array(
                                           'url'      => '@cart_delete?id='.$cartItem->getId(),
                                           'method'   => 'GET',
                                           'dataType' => 'json',
                                           'csrf'     => true,
                                           'before'   => '',
                                           'success'  => 'delete_cart_item('.$cartItem->getId().','.$company->getId().',data)',
                                       	   'error'	  => 'error_message()'
                                           ),
                                           array(
                            			   'href'  => url_for('cart_delete',$cartItem)
                                           )
              )?>


    </td>
    <td class="cart_options">

    </td>
    </tr>
    <?php $countSum += $cartItem->getSum();?>
    <?php $fullSum += $cartItem->getSum();?>
    <?php endforeach; ?>
      <tr class="cart_sum">
        <td colspan="2" class="right bold">
          <h3 class="bold">Сумма заказа:</h3>
        </td>
        <td id="countSum<?php echo $company->getId() ?>" class="bold">
          <?php echo $countSum; ?> руб.
        </td>
        <td></td>
      </tr>
      <!-- Доставка пока не доступна -->
      <!--
      <tr class="cart_sum">
        <td colspan="2" style="text-align: right;">Стоимость доставки:</td>
        <td id="countSum">  </td>
        <td></td>
      </tr>
       -->
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2" class="right bold">
        <h3 class="bold">Итог:</h3>
      </td>
      <td id="fullSum" class="bold">
        <?php echo $fullSum ?> руб.
      </td>
      <td><img width="113" height="27" src="/images/privateArea/show_order_button.png" alt="Оформить заказ" style="cursor: pointer; margin: -10px -20px;" onclick="$('#order').removeClass('hide');" /></td>
    </tr>
    <!-- Доставка пока не доступна -->
    <!--
    <tr>
      <td colspan="2" class="right">В том числе доставка:</td>
      <td id="fullSum"> </td>
      <td></td>
    </tr>
    -->
  </tfoot>
</table>
<?php endif;?>