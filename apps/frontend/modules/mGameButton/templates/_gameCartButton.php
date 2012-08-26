<?php if($sf_user->isGamer()):?>
<?php echo jq_link_to_remote(image_tag('/images/icons/game_cart_32x32.png', array('alt_title' => 'Купить за нереальные деньги')),
                                                                        array(
                                           'url'      => '@game_cart_add?item_variant_id='.$itemVariantId,
                                           'method'   => 'GET',
                                           'dataType' => 'json',
                                           'csrf'     => true,
                                           'cache'    => false,
                                           'before'   => '$("#game_mini_cart_items_count").html(loader);',
              							   '404'      => 'game_error_message(data)',
                                           'success'  => 'game_refresh_cart(data)',
                                       	   'failure'  => 'game_error_message(data)'
                                           ),
                                           array(
                                           'class' => 'add_cart',
                                           'href'  => url_for('@game_cart_add?item_variant_id='.$itemVariantId)
                                           )
                                           )?>
<?php endif;?>