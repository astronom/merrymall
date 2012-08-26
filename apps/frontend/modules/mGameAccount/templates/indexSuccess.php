<?php slot('title','Аккаунт Игрока | Мерри Молл')?>
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
							Страница Пользователя игры
						</h1>
							<?php if($sf_user->isGamer()):?>
								<?php echo link_to('К магазинам!','@companies') ?>
								<?php include_partial('mGameAccount/account', array('account' => $account, 'gameRoundsCount' => $gameRoundsCount, 'gameRoundPurchases' => $gameRoundPurchases, 'gameAccountsRoundPurchases' => $gameAccountsRoundPurchases))?>
								<br />
								<?php include_component('mGameCart', 'cartItems')?>
								<br />
								<?php include_partial('mGameAccount/rating', array('ratings' => $ratings, 'accountPosition' => $accountPosition))?>
								<br />
								<?php include_partial('mGameAccount/userItemForm', array('userItemForm' => $userItemForm))?>
								<br />
								<?php include_partial('mGameAccount/userItems', array('userItems' => $userItems))?>
							<?php elseif(!$sf_user->isGamer() && $sf_user->isAuthenticated()):?>
								<?php include_partial('mGameAccount/newAccountForm',array('suggestRulesForm' => $suggestRulesForm))?>
							<?php else:?>
								<?php include_partial('mGameAccount/signinForm',array('signinForm' => $signinForm))?>
							<?php endif;?>

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