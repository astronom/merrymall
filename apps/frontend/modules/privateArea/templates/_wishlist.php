<?php use_javascript('wishlist')?>
<?php use_helper('Text')?>
  <?php foreach($wishlist as $i => $wish): ?>
    <div id="<?php echo 'wish'.$wish->getId() ?>" class="wish<?php if(fmod($i+1,4)==0) echo " wish_last" ?>">
      <div class="wish_image">
        <a title="<?php echo $wish->getSItemVariant()->getName() ?>" class="zoomin hide" href="<?php echo $wish->getSItemVariant()->getSItem()->sImages[0]->getImageUrl() ?>"></a>
        <a href=""><?php echo image_tag($wish->getSItemVariant()->getSItem()->getThumbnailUrl(array('width'=> '60', 'height' => '60')),array('alt_title' => $wish->getSItemVariant())) ?></a>
      </div>
      <div class="wish_description">
        <a id="" title="<?php echo $wish->getSItemVariant() ?>" href="<?php echo url_for('item_info',$wish->getSItemVariant()->getSItem()) ?>" onclick="show_item_info(<?php echo 'this,'.$wish->getSItemVariant()->getSItem()->getId() ?>); return false;"><?php echo truncate_text($wish->getSItemVariant(),32) ?></a>
        <br/>
        <span class="price"><?php echo $wish->getSItemVariant()->getPrice()?> р.</span><br />
        <br/>
      </div>
      <div class="wish_actions">
      <?php echo link_to(image_tag('/images/icons/delete_16x16.png',array('alt_title'=>'Удалить', 'size' => '12x12')),
                        'wishlist_delete_one', $wish,
                            array('onclick' => 'wish_delete("'.$wish->getId().'","'.$secret_name.'","'.$secret_value.'"); return false;',
                                 'class' => 'wish_delete')) ?>

      <?php echo link_to(image_tag('/images/icons/cart_16x16.png',array('alt_title'=>'Положить в корзину')),
                        'wishlist_to_cart', $wish,
                            array('onclick' => 'move_to_cart("'.$wish->getId().'","'.$secret_name.'","'.$secret_value.'"); return false;',
                                 'class' => 'add_cart')) ?>

      </div>
   </div>
  <?php endforeach; ?>