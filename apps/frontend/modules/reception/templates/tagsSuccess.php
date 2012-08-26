<?php //use_stylesheet('texts.css') ?>
<?php //use_helper('Global') ?>
<?php //include_partial('pageParts/rigthSideBar', array('floors' => $floors, 'modules' => array('select_floor','private_area')) ) ?>
<?php //include_partial('pageParts/windowPopup')?>
<?php include_component('pageParts', 'miniCart') ?>
<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background"></div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div id="user-info">
                      <?php include_component('pageParts', 'privateArea') ?>
                   	</div>                  </div>
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
                      <h1 class="title padL15"><?php echo link_to('Магазины','@companies')?> / <?php echo link_to('Категории','@root_tags')?></h1>
                      <ul class="tags-parent-list">
                        <li class="tags-parent"><?php echo $parent_tag ?></li>
                        <?php if(true || is_set($parent_tag->getChildren())): ?>
                        <li class="tags-children-list">
                          <?php foreach($parent_tag->getChildren() as $children_tag): ?>
                          <?php echo link_to($children_tag, '@tags?tag_id=' . $children_tag->getId(), array('class'=>'tags-children')) ?>
                          <?php endforeach ?>
                        </li>
                        <?php endif ?>
                      </ul>
                      <?php if($parent_tag->getSItems()): ?>
                        <h3 class="padL15">Товары</h3>
                        <ul>
                          <?php foreach($parent_tag->getSItems() as $item): ?>
                           <li><?php echo link_to($item->getName(), '@item_info?item_id='.$item->getId())?></li>
                          <?php endforeach ?>
                        </ul>
                      <?php endif ?>
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