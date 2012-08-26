<style>
.katlist { margin:0; padding:0; }
.katlist li { list-style-type:none; margin:0; padding:0 4px 0 0; float:left; height: 350px;}
.kg1 { width:162px; height:225px; background:url(/images/c/images.gif) top left no-repeat; text-align:center; vertical-align:middle; }
.kg2 { text-align:center; padding:8px 10px 15px 10px; font-size:13px; }
.kg3 { color:#3c6e0f; font-size:18px; text-align:center; }
.kg3 a { color:#3c6e0f; text-decoration:none; }
.kg4 { text-align:center; color:#3c6e0f; padding:0 10px 20px 10px; font-size:13px; }
.kg4 a { color:#3c6e0f; text-decoration:underline; }
.kg4 a:hover { text-decoration:none; }
.tovar_info {
      width: 370px; height: 300px;
      border-radius: 7px;
      -moz-border-radius: 7px;
      -webkit-border-radius: 7px;
      border: 1px solid #7c93af;
      margin-left: 170px;
      color:#3c6e0f;}
  .tovar_param {margin: 20px 0px 20px 25px; width: 100%; }
  .tovar_param td {padding-top: 10px;}
  .param_name { background: url("/images/c/dot.png") 0% 90% repeat-x; }
  .param_name b {background: #fff;}
  .tovar_info p {margin: 18px 10px 0px 25px;}

</style>
<div id="shop_tovar">
  <ul class="katlist">
    <li>
      <table class="catalog" cellspacing="0" cellpadding="0">
        <tr>
          <td class="kg1">
            <img id="itemImage" style="cursor: pointer;" src="<?php echo $item->sImages[0]->getThumbnailUrl(150)?>" />
          </td>
        </tr>
        <tr>
          <td class="kg2" style="color:#0a6093;">
            <?php echo $item->getName() ?>
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
          </td>
        </tr>
      </table>
    </li>
  </ul>
  <div class="tovar_info" id="c-actions">
<!-- Свойства товара -->
  <?php if(count($itemPropertyValues)>0):?>
    <table class="tovar_param" cellspacing="0" cellpadding="0">

    <?php foreach ($itemPropertyValues as $itemPropertyValue):?>
    <tr>
        <td class="param_name"><b><?php echo $itemPropertyValue->getSProperty()->getName() ?></b></td>
        <td><?php echo $itemPropertyValue->getValue()?></td>
    </tr>
    <?php endforeach;?>
    </table>
  <?php endif;?>
<!-- END Свойства товара -->
<!-- Описание товара -->
    <p><?php echo $item->getDescription(ESC_RAW); ?></p>
<!-- END Описание товара -->
  </div>
</div>