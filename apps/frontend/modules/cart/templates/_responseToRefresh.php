<?php use_helper('Price') ?>
<div id="mini_cart_item<?php echo $cartItem['id'] ?>" class="mini_cart_item">
	<div class="mini_cart_item_name">
	<a id="show_item" title="<?php echo $item_variant['iv_name'] ?>" href="<?php echo url_for('item_info', array('company_type' => $item_variant['c_type'],
                                                           									  					 'url' => $item_variant['c_url'],
                                                           									  					 'id'  => $item_variant['iv_item_id'])) ?>">
      <?php echo $item_variant['iv_name'] ?>
	</a>
	</div>
	<div class="mini_cart_item_count">
      <?php echo $cartItem['count'].' шт.' ?>
	</div>
	<div class="mini_cart_item_price">
      <?php echo price($item_variant['iv_price']) ?>
	</div>
	<div class="mini_cart_item_delete">
      <?php echo jq_link_to_remote(image_tag('icons/delete_16x16.png', array('alt' => 'X', 'title' => 'Удалить', 'size' => '12x12')),
                                           array(
                                           'url'      => '@cart_delete?id='.$cartItem['id'],
                                           'method'   => 'GET',
                                           'dataType' => 'json',
                                           'csrf'     => true,
                                           'before'   => '$("#cart_items_count").html(loader);',
                                           'success'  => 'delete_cart_item('.$cartItem['id'].',data)',
                                       	   'error'	  => 'error_message()'
                                           ),
                                           array(
                            			   'href'  => url_for('cart_delete',array('id' => $cartItem['id']))
                                           )
      ) ?>
	</div>
	<div id="mini_cart_item_sum" class="hide"><?php echo $cartItem['count']*$item_variant['iv_price'] ?></div>
</div>
