<?php slot('title','Архив Покупок Игрока | Мерри Молл')?>
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
                      <!-- Game Account -->
                      <div id="wishlist" class="wishlist">
                        <h1 class="title">
							Архив покупок Игрока
						</h1>
						<?php echo link_to('Аккаунт игрока','@game_account')?>
							<?php //include_partial('cartItems',array('cartItems' => $cartItems))?>
							<?php $round = 0; ?>
							<?php foreach ($cartItems as $cartItem):?>
							  <?php if($cartItem['round'] != $round): ?>
							    <?php $round = $cartItem['round'] ?>
							    <?php echo '<p>'.$cartItem['round'].' Тур</p>'?>
							  <?php endif;?>
	                          <?php echo $cartItem['sItemVariant']['name'] ?>
	                          <?php echo $cartItem['price'] ?>
							   <br />
                            <?php endforeach;?>
                      <!-- Game Account -->
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
            </div>
			<!-- Footer -->
            <div id="page_footer">

            </div>
			<!-- End Footer -->
        </div>
</div>