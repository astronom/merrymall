<?php slot('title',sprintf('%s компании %s | Мерри Молл', $companyType, $company->getName()))?>
<?php include_partial('cart/miniCart', array('form' => $form)) ?>

<script type="text/javascript">

   $(document).bind('ready', function (){

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
//  	Обработчик события наведения мышки на картинку товара -> появляется увеличалка
  	$('.store-item-image').live('mouseover mouseout',

         function (ev) {
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

<?php include_component('pageParts','miniCart')?>
<?php include_component('pageParts','chat', array('phone' => $company->getProfile()->getPhone(), 'company_id' => $company->id))?>
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
						  <div class="office-item">
						  	<h2 class="title"><?php echo $officeText->getTitle()?></h2>
						  	<div class="office-item-content">
						  	  <?php echo $officeText->getText(ESC_RAW) ?>
						  	</div>
                          </div>
                        <div class="separator"></div>
                        <div class="paginator" id="paginator"></div>
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