<?php use_helper('Price') ?>
<div id="game_mini_cart_item<?php echo $cartItem['id'] ?>" class="game-mini-cart-item">
	<div class="game-mini-cart-item-name">
		<a id="show_item" title="<?php echo $item_variant['iv_name'] ?>" href="<?php echo url_for('item_info', array('company_type' => $item_variant['c_type'],
                                                           									  					 'url' => $item_variant['c_url'],
                                                           									  					 'id'  => $item_variant['iv_item_id'])) ?>">
		<?php echo $item_variant['iv_name'] ?></a>
	</div>
	<div class="game-mini-cart-item-price">
      <?php echo price($item_variant['iv_price']) ?>
    </div>
    <div class="game-mini-cart-item-delete">
              <?php echo jq_link_to_remote(image_tag('icons/delete_16x16.png', array('alt' => 'X', 'title' => 'Удалить', 'size' => '12x12')),
                                           array(
                                           'url'      => '@game_cart_delete?id='.$cartItem['id'],
                                           'method'   => 'GET',
                                           'dataType' => 'json',
                                           'csrf'     => true,
                                           'before'   => '$("#game_mini_cart_items_count").html(loader);',
                                           'success'  => 'game_remove_cart_item('.$cartItem['id'].',data)',
                                       	   'error'	  => 'error_message()'
                                           ),
                                           array(
                            			   'href'  => url_for('game_cart_delete',array('id' => $cartItem['id']))
                                           )
              )?>
	</div>
	<div id="game_mini_cart_item_sum" class="hide"><?php echo $item_variant['iv_price'] ?></div>
</div>
