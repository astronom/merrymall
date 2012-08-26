<?php include_component('pageParts', 'miniCart') ?>
<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background companies"></div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div id="user-info">
                      <?php include_component('pageParts', 'privateArea') ?>
                    </div>
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
                      <h1 class="title padL15">Карта сайта</h1>
                      <ul class="sitemap">
                      	<li><?php echo link_to('Главная','@homepage')?>
                      		<ul>
      							<li><a href="<?php echo url_for('@about')?>">О проекте</a></li>
      							<li><a href="<?php echo url_for('@news')?>">Новости</a></li>
      							<li><a href="<?php echo url_for('@actions') ?>">Акции</a></li>
      							<li><a href="<?php echo url_for('@adds')?>">Реклама</a></li>
      							<!-- <li><a href="<?php //echo url_for('@reception')?>">Ресепшн</a></li>  -->
      							<li><a href="<?php echo url_for('@rent')?>">Арендаторам</a></li>
      							<li><a href="<?php echo url_for('@root_tags')?>">Категории</a></li>
      							<li><a href="<?php echo url_for('@companies')?>">Магазины | Товары</a>
      							<?php $at_first = true;?>
                                      <?php foreach($companies as $company):?>
					                    <?php if($floor != $company->getFloor()): ?>
					                    <?php if(!$at_first) echo '</ul></li>'; $at_first=false; ?>

						                <ul><li><?php echo link_to($company->getFloor(), '/floor/'.$company->getFloor()->getUrl()) ?><ul>
						                <?php else: ?>
						  						<li><a href="<?php echo url_for('company', $company)?>"><?php echo $company->getName()?></a></li>
										<?php endif;?>
										  <?php $floor = $company->getFloor(); ?>
									<?php endforeach;?>

      								</ul>
      							</li>
      						</ul>
                      	</li>
                      </ul>
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
        </div>
</div>