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
                    <!-- Cart Start -->
<!--                    <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/>Корзина</h2> -->
                        <?php //include_partial('cart',array('companies' => $companies, 'secret_name' => $secret_name, 'secret_value' => $secret_value ))?>
                    <!-- Cart End -->
<!--                        <div class="separator"> -->
<!--                            &nbsp; -->
<!--                        </div> -->
                    <!-- Profile Start -->
                        <div id="profile">
                            <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/>Личные данные</h2>
                            <div class="order-content"><?php echo link_to('Изменить личные данные','@private_area_edit_profile')?></div>
                        </div>
                    <!-- Profile End -->
                    <?php if($companies_count > 0): ?>
                    <!-- Order Start -->
                        <div id="order">
                            <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/>Оформление заказа</h2>
                            <?php include_partial('order',array('companies' => $companies))?>
                        </div>
                    <!-- Order End -->
                    <?php endif; ?>
                    <!-- Orders List Start -->
                        <div id="order">
                            <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/>Оформленные заказы</h2>
                            <?php include_partial('ordersList',array('ordersList' => $ordersList))?>
                        </div>
                    <!-- Orders List End -->
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