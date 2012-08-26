<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background privateArea">
                </div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div class="page_name"></div>
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
                    <!-- Profile Start -->
                        <div id="profile">
                            <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/><?php echo link_to('Личный кабинет', '@private_area')?> / Изменить личные данные</h2>
                            <?php include_partial('profileForm',array('form' => $profileForm))?>
                        </div>
                    <!-- Profile End -->
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
            </div>
			<!-- Footer -->
            <div id="page_footer">

            </div>
			<!-- End Footer -->
        </div>
</div>