<?php use_helper('Text','Price') ?>

<?php foreach ($items as $item): ?>
<?php $itemVariant = $item->getSItemVariants()?>
<?php if($itemVariantId = $itemVariant[0]->getId()):?>
<?php else: $itemVariantId=0; ?>
<?php endif; ?>
<div class="store-item" style="padding-top: 20px;">
<?php if($itemVariant) echo price($itemVariant[0]->getPrice(), false, true )?>
                  <?php echo link_to(image_tag('/images/icons/cart_32x32.png', array('alt_title' => 'Положить в корзину')),
                             'cart_add',array('item_variant_id' => $itemVariantId, 'count' => 1),
                                      array('class' => 'add_cart','onClick' => 'open_cart_item(this,'.$itemVariantId.'); return false;')) ?>
  <div class="store-item-image">
  <a title="<?php echo $item->getName() ?>" class="zoomin_company" href="<?php echo $item->sImages[0]->getImageUrl() ?>"></a>
  <a href="<?php echo url_for('item_info',$item) ?>" title="<?php echo $item->getName(); ?>">
  <?php echo image_tag($item->getThumbnailUrl(array('width'=> '150', 'height' => '140')), array('alt' => $item->getName())) ?>
  </a>
</div>
<a class="store-item-name" href="<?php echo url_for('item_info', $item) ?>" title="<?php echo $item->getName(); ?>"><?php echo truncate_text($item->getName(),29); ?></a>
</div>
<?php endforeach; ?>
