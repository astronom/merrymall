<?php use_helper('Global') ?>
<?php //include_partial('pageParts/rigthSideBar', array( 'modules' => array('private_area')) ) ?>
<?php //include_partial('pageParts/windowPopup')?>
<?php use_javascript('hallPresentation')?>
<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background floor"></div>
                <div id="page-content-floor" class="">
                  <div class="page_content-top-floor">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div id="banner" class="banner">
                      <?php include_partial('banner360x90') ?>
                    </div>
                    <div id="user-info">
                      <?php include_component('pageParts', 'privateArea') ?>
                   	</div>
                  </div>
                <div class="vertical-floor">
                  <?php include_partial('verticalFloorSelector', array('floor_is_top' => $floor_is_top, 'floor_is_bottom' => $floor_is_bottom)) ?>
                </div>
                <div id="hall-shopwindows-container">
                  <ul>
                    <li id="company-0"><a href="/gallery"><?php echo image_tag('floor/sw_gallery_be_soon.jpg', 'size=389x295')?></a></li>
                    <li id="company-1"><a href="/chat"><?php echo image_tag('floor/sw_chat_be_soon.jpg', 'size=389x295')?></a></li>
                  </ul>
                </div>
                <div id="hall-person-girl">
                  <div id="bubble_girl" class="bubble_girl">
                    <table class="_bubble-main" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td class="_bubble-top-left"></td>
                          <td class="_bubble-top-center"></td>
                          <td class="_bubble-top-right"></td>
                        </tr>
                        <tr>
                          <td class="_bubble-center-left"></td>
                          <td class="_bubble-center-center">
                        <div id="bubble_content_girl" class="bubble_content">
                          Привет! Меня зовут Мэри. Я знаю, как не потеряться в нашем торговом центре и найти нужный магазин.
                          <div id="presentation" class="" style="color: #005388; font-size: 16pt; text-align: right;">
                            <a href="#">Расскажи!</a>
                          </div>
                        </div>
                          </td>
                          <td class="_bubble-center-right"></td></tr>
                        <tr>
                          <td class="_bubble-bottom-left"></td>
                          <td class="_bubble-bottom-center"></td>
                          <td class="_bubble-bottom-right"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
                <div id="hall-person-boy">
                  <div id="bubble_boy" class="bubble">
                    <table class="bubble-main" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td class="bubble-top-left"></td>
                          <td class="bubble-top-center"></td>
                          <td class="bubble-top-right"></td>
                        </tr>
                        <tr>
                          <td class="bubble-center-left"></td>
                          <td class="bubble-center-center">
                        <div id="bubble_content_boy" class="bubble_content">
                        </div>
                          </td>
                          <td class="bubble-center-right"></td></tr>
                        <tr>
                          <td class="bubble-bottom-left"></td>
                          <td class="bubble-bottom-center"></td>
                          <td class="bubble-bottom-right"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php include_partial('bottomMenu', array('floors' => $floors, 'floor' => $floor)) ?>
            </div>
        </div>
    <!-- Footer -->
        <div id="page_footer">

        </div>
    <!-- End Footer -->
</div>