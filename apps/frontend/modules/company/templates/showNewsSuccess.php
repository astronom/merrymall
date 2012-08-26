<?php slot('title',sprintf('%s компании %s | Мерри Молл', $companyType, $company->getName()))?>
<?php include_component('pageParts','chat', array('phone' => $company->getProfile()->getPhone(), 'company_id' => $company->id))?>
<?php include_component('pageParts', 'miniCart') ?>
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

                        <h1 class="title"><a href="<?php echo url_for('company_news',$company)?>">Новости</a> / <span><?php echo $newsItem->getTitle()?></span></h1>
                        <h2 class="title"></h2>
                        <div class="company-content-text">
                          <div class="text">
                            <?php echo $newsItem->getText(ESC_RAW) ?>
                            <div class="separator"></div>
                            <span class="date"><?php echo $newsItem->getDateTimeObject('date')->format('d.m.Y') ?></span>
                          </div>


                        </div>
                        <div class="separator"></div>
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