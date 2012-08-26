<?php use_helper('Global') ?>
<?php //include_partial('pageParts/windowPopup')?>
<script type="text/javascript">
  var companies_array = <?php echo $js_cp_array; ?>;

  $(function()
  {
    <?php if ($floor->hasCompanies()): ?>
    $("#shopwindows-container > .mask").jCarouselLite(
    {
      btnNext: "#fl-nav-arror-right_shop, #fl-nav-arror-right",
      btnPrev: "#fl-nav-arror-left",
      speed: 1000,
      visible: 2,
      afterStart: function(a)
      {
        selectCompany(a[0].id.substring(4));
      }
    });

      scrollToCompany(<?php echo $sf_request->hasParameter('position') ? $sf_request->getParameter('position') : $companies[0]->getId() ?>);

    <?php endif; ?>

  });

  function scrollToCompany(id)
  {
    $("#shopwindows-container > .mask").goTo(jQuery.inArray(id, companies_array));
    selectCompany(id);
    $('#bm-s-sh-w').slideUp();
  }

  function selectCompany(id)
  {
    var href = $("#bcp-" + id + " > a").attr("href", href);
    $("#shop-enter").attr("href", href);
    $("#shop-enter-arror-up").attr("href", href);
    $("#shop-enter-arror-down").attr("href", href);

    var title = $("#bcp-" + id + " > a").html();
    $("#bm-s-sh-name").html(title);

    $("ul.cs > li > a").removeClass("c-selected");
    $("ul.cs > li#bcp-" + id + " > a").addClass("c-selected");
  }
</script>
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
                      <?php //include_partial('banner360x90') ?>
                      <?php include_partial('opensoon360x90') ?>
                    </div>
                    <div id="user-info">
                      <?php include_component('pageParts', 'privateArea') ?>
                   	</div>
                  </div>
                <div class="vertical-floor">
                  <?php include_partial('verticalFloorSelector', array('floor_is_top' => $floor_is_top, 'floor_is_bottom' => $floor_is_bottom)) ?>
                </div>
                <div id="shopwindows-container">
                  <div class="mask">
                    <ul>
                      <?php if ($floor->hasCompanies()): ?>
                      <?php foreach ($companies as $id => $company): ?>
                        <li id="lcp-<?php echo $company->getId() ?>"><?php echo link_to(image_tag($company->getShopwindow(), 'size=389x295'),'company',$company ,array('title' => 'Войти внутрь')) ?></li>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
                <?php if ($floor->hasCompanies()): ?>
                <div id="fl-nav-container">
                  <div title="Следующая витрина" id="fl-nav-arror-right_shop" style="width: 400px; height: 308px; background: none; position: absolute; top: 24px; left: 250px; cursor: pointer; z-index: 1;" /></div>
                  <a href="#" id="shop-enter-arror-up" title="Войти внутрь"><img alt="" src="/images/floor/arror_up.png" width="82" height="32" /></a>
                  <a href="#" id="fl-nav-arror-left" title="Предыдущая витрина"><img alt="" src="/images/floor/arror_left.png" width="50" height="40" /></a>
                  <a href="#" id="fl-nav-arror-right" title="Следующая витрина"><img alt="" src="/images/floor/arror_right.png" width="50" height="40" /></a>
                </div>
                <?php endif; ?>
                <?php include_partial('bottomMenu', array('floors' => $floors, 'floor' => $floor, 'companies' => $companies)) ?>
            </div>
        </div>
</div>