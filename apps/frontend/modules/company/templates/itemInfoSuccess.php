<?php use_helper('Price') ?>
<?php slot('title',sprintf('%s компании %s | Мерри Молл', $companyType, $company->getName()))?>
<?php include_partial('cart/miniCart', array('form' => $form)) ?>
<script type="text/javascript">
<?php //echo $item->getImageGallery(150, ESC_RAW) ?>
  $(function()
  {
      //Декоративная штучка, уравнивающая высоты блоков
      $('.store-item-info').css('min-height', function() {
    	  return $('.store-item').innerHeight() - 27 + 'px';
          });
      //Табы информации о товаре
      var tabContainers = $('div.store-item-info > div'); // получаем массив контейнеров
      tabContainers.hide().filter(':first').show(); // прячем все, кроме первого
      // далее обрабатывается клик по вкладке
      $('div.store-item-info ul.tabNavigation a').click(function () {
          tabContainers.hide(); // прячем все табы
          tabContainers.filter(this.hash).show(); // показываем содержимое текущего
          $('div.store-item-info ul.tabNavigation a').removeClass('selected'); // у всех убираем класс 'selected'
          $(this).addClass('selected'); // текушей вкладке добавляем класс 'selected'
          return false;
      }).filter(':first').click();

      //Включаем лайтбокс
      $('.zoomin_company').lightBox({
    			overlayBgColor: '#83b4d5',
    			overlayOpacity: 0.6,
    			imageLoading: '/images/loader/loader_small4.gif',
    			imageBtnClose: '/images/icons/close.png',
    			imageBtnPrev: '/images/icons/left_arrow.png',
    			imageBtnNext: '/images/icons/right_arrow.png',
    			containerResizeSpeed: 350,
    			txtImage: 'Изображение',
    			txtOf: 'из'

      });
      $('.zoomin_company').addClass('hide');
//    	Обработчик события наведения мышки на картинку товара -> появляется увеличалка
    	$('.store-item-image').live('mouseover mouseout',
           function(ev) {
  		    var zoomin = $(this).children('.zoomin_company');

            if (ev.type == 'mouseover') {
            	zoomin.removeClass('hide');
            }

            if (ev.type == 'mouseout') {
            	zoomin.addClass('hide');
            }
    	});
  });
</script>
  <?php include_component('pageParts', 'miniCart') ?>
<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background <?php echo $company->getType() ?>"></div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div class="company_banner_<?php echo $company->getType() ?>">
                      <?php echo image_tag($company->getLogo()) ?>
                    </div>
                    <div id="user-info">
                     <?php include_component('pageParts', 'privateArea') ?>
                     </div>
                    <div id="register-now">
                      <?php include_partial('registernow470x60')?>
                    </div>
                </div>
                <div id="page_content-left">
                  	<?php include_partial('shopsOnFloor', array('shopsOnFloor' => $shopsOnFloorList))?>
                </div>

                <div class="rounded-box-10">
                    <b class="r10 white"></b>
                    <b class="r9 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <div class="content">
                      <div class="company-menu">
                        <?php include_partial('companyMenu', array('company' => $company))?>
                      </div>
                      <div class="company-content">
                        <div class="company-content-catalog">
                            <?php include_partial('categoriesTree', array('treeObject' => $treeObject, 'rootId' => $rootId, 'companyUrl' => $company->getUrl(), 'companyType' => $company->getType())) ?>
                        </div>
                        <div class="company-content-store">
                        <?php $itemVariant = $item->getSItemVariants()?>
                        <?php if($itemVariantId = $itemVariant[0]->getId()):?>
                        <?php else: $itemVariantId=0; ?>
                        <?php endif; ?>
                          <div class="store-item" style="height: auto;">
                            <div class="store-item-image" style="margin-top: 20px;">
                              <a title="<?php echo $item->getName() ?>" class="zoomin_company" href="<?php echo $item->sImages[0]->getImageUrl() ?>"></a>
                              <?php echo image_tag($item->sImages[0]->getThumbnailUrl(array('width'=> '150', 'height' => '140')), array('alt_title' => $item->getName())) ?>
                            </div>
                            <span class="store-item-name"><?php echo $item->getName(); ?></span>
                            <?php if($itemVariant) echo price($itemVariant[0]->getPrice(), false, true, 'p', 'price top5px') ?>
                              <?php echo link_to(image_tag('/images/icons/cart_32x32.png', array('alt_title' => 'Положить в корзину')),
                                      'cart_add',array('item_variant_id' => $itemVariantId, 'count' => 1),
                                       array('class' => 'add_cart top10px','onClick' => 'open_cart_item(this,'.$itemVariantId.'); return false;')) ?>

                          </div>
                          <div class="store-item-info">
                          <!-- Это сами вкладки -->
                            <ul class="tabNavigation">
                              <li><a href="#first">Описание</a></li>
                              <li><a href="#second">Свойства</a></li>
                              <li><a href="#third">Галерея</a></li>
                            </ul>
                          <!-- Это контейнеры содержимого -->
                          <div id="first">
                            <!-- Описание товара -->
                            <p class="info"><?php echo $item->getDescription(ESC_RAW); ?></p>
                            <!-- END Описание товара -->
                          </div>
                          <div id="second">
                            <table class="store-item-properties" cellspacing="0" cellpadding="0">
                            <!-- Свойства товара -->
                            <?php foreach ($itemPropertyValues as $itemPropertyValue):?>
                              <tr>
                                <td class="param_name"><b><?php echo $itemPropertyValue->getSProperty()->getName() ?></b></td>
                                <td><?php echo $itemPropertyValue->getValue()?></td>
                              </tr>
                            <?php endforeach;?>
                            </table>
                            <!-- END Свойства товара -->
                          </div>
                          <div id="third">
                            <div class="store-item-gallery">
                            <?php foreach($item->getSImages() as $image): ?>
                              <?php if(!$image->isMain()):?>
                              <div class="store-item-image">
                              <a title="<?php echo $item->getName() ?>" class="zoomin_company" href="<?php echo $image->getImageUrl() ?>"></a>

                               <?php echo image_tag($image->getThumbnailUrl(array('width'=> '150', 'height' => '140'))) ?>

                              </div>
                              <?php endif;?>
                            <?php endforeach;?>
                            </div>
                          </div>
                          </div>
                          <div class="separator"></div>
              </div>
            </div>
                    </div>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r10 white"></b>
                </div>
                <div id="page_content-right">
                  	<?php include_partial('randomShops', array('shopsRandomList' => $shopsRandomList))?>
                </div>
            </div>
        </div>
</div>