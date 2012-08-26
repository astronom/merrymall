<!-- Footer -->
<script>
$(function()
{
    $(".mouseWheelButtons #footer-floor-shops").jCarouselLite(
          {
            btnNext: ".mouseWheelButtons #floor-shops-nav-right",
            btnPrev: ".mouseWheelButtons #floor-shops-nav-left",
            speed: 500,
            visible: 3.5,
            circular: true,
            mouseWheel: true
          });
	$(".mouseWheelButtons #footer-random-shops").jCarouselLite(
    	    {
    	      btnNext: ".mouseWheelButtons #random-shops-nav-right",
    	      btnPrev: ".mouseWheelButtons #random-shops-nav-left",
    	      speed: 500,
    	      visible: 3.5,
    	      circular: true,
    	      mouseWheel: true
    	    });
   var footerWidth;
   $('.footer-left').css('width', function(){footerWidth = $('body').width()/2 - 20;  return footerWidth + 'px'; })
                        .children('.footer-nav-right').css('left', function(){return footerWidth - 120 + 'px';});
   $('.footer-right').css('width', function(){footerWidth = $('body').width()/2 - 20;  return footerWidth + 'px'; })
                    .children('.footer-nav-right').css('left', function(){return footerWidth - 120 + 'px';});

   if(!$.browser.msie) {
    $('.footer-nav-left, .footer-nav-right').addClass('footer-nav-hide');
//	Обработчик события наведения мышки на картинку товара -> появляется увеличалка
	$('.footer-nav-left, .footer-nav-right').live('mouseover mouseout',

       function (ev) {
        if (ev.type == 'mouseover') {
        	$(this).removeClass('footer-nav-hide');
        }

        if (ev.type == 'mouseout') {
        	$(this).addClass('footer-nav-hide');
        }
	     });
   }
});

</script>
<div id="page_footer">
<div class="page_footer-title-left"><span style="background-color: rgb(131, 180, 213); padding: 0 10px 5px 12px; margin-right: 20px; ">Магазины на <a href="<?php echo url_for('/floor/'.$floor_url)?>"><?php echo $floor_name ?>е</a></span></div>
<div class="page_footer-title-right"><span style="background-color: rgb(131, 180, 213); padding: 0 10px 5px 12px; margin-left: 8px;">Рекомендуем вам посетить</span></div>
<div class="separator"></div>
  <div class="footer-left  mouseWheelButtons">
     <div id="floor-shops-nav-left" class="footer-nav-left">
    </div>
    <div id="floor-shops-nav-right" class="footer-nav-right" ></div>
  <div id="footer-floor-shops" class="footer-random-shops">
  <ul>
  <?php foreach($shopsOnFloorList as $floorShop): ?>
    <li>
      <a href="<?php echo url_for('@floor_companies?floor_id='.$floorShop->getFloor()->getUrl().'&position='.$floorShop->getId())?>">
        <?php echo image_tag($floorShop->getLogo(),
                        array('alt_title'=>$floorShop->getName(),
                        	 'size' => '130x50')) ?>
      </a>
  <?php endforeach;?>
     </li>
  </ul>
  </div>

  </div>
  <div class="page-footer-separator"></div>
    <div class="footer-right  mouseWheelButtons">
     <div id="random-shops-nav-left" class="footer-nav-left">
    </div>
    <div id="random-shops-nav-right" class="footer-nav-right" ></div>
  <div id="footer-random-shops" class="footer-random-shops">
  <ul>
  <?php foreach($shopsRandomList as $randomShop): ?>
    <li>
      <?php echo link_to(image_tag($randomShop->getLogo(),
                        array('alt_title'=>$randomShop->getName(),
                           'size' => '130x50')),
                       'company',$randomShop)?>
  <?php endforeach;?>
     </li>
  </ul>
  </div>

  </div>
</div>
<!-- End Footer -->
