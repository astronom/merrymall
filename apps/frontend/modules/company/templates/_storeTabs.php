<?php
if(sizeof($items))
  include_partial('storeItems', array('items' => $items, 'isItemRequest' => $isItemRequest, 'pager' => $pager, 'company' => $company, 'category_id' => @$category_id));
else
  include_partial('defaultStoreItems');
?>
<div class="hid" id="c-description">
  <h1>О магазине</h1>
  <p><?php echo $profile->getDescription(ESC_RAW); ?></p>
</div>
<div class="hid" id="c-contacts">
  <h1>Контакты</h1>
  <p><?php echo $profile->getContacts(ESC_RAW); ?></p>
</div>
<div class="hid" id="c-news">
  <h1>Новости</h1>
  <p><?php echo $profile->getNews(ESC_RAW); ?></p>
  <!--<p class="news_preveiw">
    <span class="date">3 апреля 2010</span><a href="#">Первая новость</a></p>-->
</div>
<div class="hid" id="c-actions">
  <h1>Акции</h1>
  <p><?php echo $profile->getActions(ESC_RAW); ?></p>
  <!--<p class="news_preveiw"><span class="actions">Скидки на весь ассортимент 30%!</span><a href="#">Первая акция</a></p><p>Дополнительное описание акции. Дополнительное описание акции. Дополнительное описание акции.</p><p class="news_preveiw"><span class="actions">При покупке телефона, чехол в подарок!</span><a href="#">Вторая новость</a></p><p>Дополнительное описание акции. Дополнительное описание акции. Дополнительное описание акции.</p>-->
</div>


<div <?php echo 'class=' . (!$isItemRequest ? '"hid"' : '"vis"')?> id="c-tovar">
<?php if(isset($item)):?>
  <div id="shop_tovar">
    <ul class="katlist">
      <li>
        <table class="catalog" cellspacing="0" cellpadding="0">
          <tr>
            <td class="kg1">
              <?php echo image_tag($item->getThumbnailUrl(150)) ?>
            </td>
          </tr>
          <tr>
            <td class="kg2">
              <a href="#" onclick="switchTab('c-tovar'); return false;"><?php echo $item->getName(); ?></a>
            </td>
          </tr>
          <tr>
            <td class="kg3">
              <?php $itemVariant = $item->getSItemVariants()?>
              <?php if($itemVariant) echo $itemVariant[0]->getPrice() . ' руб.'?>
            </td>
          </tr>
          <tr>
            <td class="kg4">
              <div id="addincart">
                <?php $itemVariant = $item->getSItemVariants()?>
                <?php if($itemVariantId = $itemVariant[0]->getId()):?>
                <?php else: $itemVariantId=0; ?>
                <?php endif; ?>
                <?php echo link_to('в корзину',
                           'cart/add?item_variant_id='.$itemVariantId,
                                    array('onClick' => 'open_cart_item(this,'.$itemVariantId.'); return false;')) ?>
              </div>
              <div id="addwish<?php echo $itemVariantId ?>">
                <?php echo link_to('в wishlist',
                                   'wishlist/add?item_variant_id='.$itemVariantId,
                                    array('onClick' => 'add_wishlist_item('.$itemVariantId.'); return false;')) ?>
              </div>
            </td>
          </tr>
        </table>
      </li>
    </ul>
    <div class="tovar_info" id="c-actions">
      <table class="hid tovar_param" cellspacing="0" cellpadding="0">
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>98</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>53х98х14</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>USB, Bluetooth</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>microSD (TransFlash)</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>321</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>1,23 1304�968</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>WAP 2.0, GPRS</td>
        </tr>
        <tr>
          <td class="param_name"><b>Параметр</b></td>
          <td>12</td>
        </tr>
      </table>
      <p><?php echo $item->getDescription(); ?></p>
    </div>
  </div>
<?php endif?>
</div>