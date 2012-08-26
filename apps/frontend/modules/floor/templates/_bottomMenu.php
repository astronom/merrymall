<script type="text/javascript">
  $(function()
  {
    // set position of bottom floating men
    <?php if ($floor->hasCompanies()): ?>
    $('#bm-s-sh-w-container').css('top', -$('#bm-s-sh-w-container').height());
    <?php endif; ?>
    $('#bm-s-fl-w-container').css('top', -$('#bm-s-fl-w-container').height());

    // animate bottom floating menu
    <?php if ($floor->hasCompanies()): ?>
    $('#bm-s-sh').click(function ()
    {
      $('#bm-s-sh-w').filter(':not(:animated)').slideToggle();
      $('#bm-s-fl-w').slideUp();
    });
    <?php endif; ?>
    $('#bm-s-fl').click(function ()
    {
      $('#bm-s-fl-w').filter(':not(:animated)').slideToggle();
      $('#bm-s-sh-w').slideUp();
    });

    $(document).click(function(e){
      var target = $(e.target);
      if (
        target.is('#bm-s-fl-w') ||
        target.parents('#bm-s-fl-w').length ||
        target.is('#bm-s-fl-w') ||
        target.parents('#bm-s-fl-w').length
      )
        return;
      $('#bm-s-sh-w').filter(':visible :not(:animated)').slideUp();
      $('#bm-s-fl-w').filter(':visible :not(:animated)').slideUp();
    });
  });
</script>
<div id="bmenu" <?php if ($floor->isHall()) echo 'class="bmenu-hall"'; ?>>
  <div id="bm-s-sh">
    <span id="bm-s-sh-cn">Выбор магазина</span>
    <span id="bm-s-sh-name"><?php if ($floor->hasCompanies()) echo $companies[0]->getName(); ?></span>
  </div>
  <div id="bm-s-fl">
    <span id="bm-s-fl-cn">Переход на этаж</span>
    <span id="bm-s-fl-name"><?php echo $floor->getName() ?></span>
  </div>
  <div id="bm-s-sh-w-container">
    <div id="bm-s-sh-w">
      <table class="pb" cellpadding="0" cellspacing="0">
        <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
        <td class="content">
          <ul class="cs">
            <?php if ($floor->hasCompanies()): ?>
            <?php foreach ($companies as $company): ?>
            <li id="bcp-<?php echo $company->getId(); ?>">
              <a class="cp" href="<?php echo url_for('company',$company); ?>" onclick="scrollToCompany(<?php echo $company->getId(); ?>); return false;"><?php echo $company->getName(); ?></a>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </td>
        <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
      </table>
    </div>
  </div>
  <div id="bm-s-fl-w-container">
    <div id="bm-s-fl-w">
      <table class="pb" cellpadding="0" cellspacing="0">
        <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
        <td class="content">
          <ul>
            <?php echo floor_select_helper($floors, $floor->getUrl())?>
          </ul>
        </td>
        <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
      </table>
    </div>
  </div>
</div>
