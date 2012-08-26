<?php //use_stylesheet('texts.css') ?>
<?php //use_helper('Global') ?>
<?php //include_partial('pageParts/rigthSideBar', array('floors' => $floors, 'modules' => array('select_floor','private_area')) ) ?>
<?php //include_partial('pageParts/windowPopup')?>
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
                      <h1 class="title padL15">Магазины / <?php echo link_to('Категории','@root_tags')?></h1>
                      <?php foreach($companies as $company):?>
					    <?php if($floor != $company->getFloor()): ?>
						  <?php if($floor != '') echo '</tr></table><div class="floor_separator"></div>' ?>
						  <table class="shops_table" cellspacing="0" cellpadding="0">
						  <tr class="floor-index"><td><?php echo link_to($company->getFloor(), '/floor/'.$company->getFloor()->getUrl()) ?></td></tr>
						  <tr><td><a href="<?php echo url_for('company', $company)?>"><?php echo image_tag($company->getLogo(), array('alt_title' => 'Перейти в магазин '.$company->getName(), 'size' => '200x75')) ?></a></td>
					      <?php $floor = $company->getFloor(); $i=1; ?>
					    <?php else: ?>
						  <?php if(fmod($i,3) == 0): ?>
						  </tr><tr>
						<?php endif;?>
						  <td><a href="<?php echo url_for('company', $company)?>"><?php echo image_tag($company->getLogo(), array('alt_title' => 'Перейти в магазин '.$company->getName(), 'size' => '200x75')) ?></a></td>
						<?php $i++;?>
					<?php endif; ?>
					<?php endforeach;?>
                    </tr></table><div class="floor_separator"></div>
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