<div id="sr" class="sidebar">
  <ul id="rmenu">
    <?php foreach ($modules as $module): ?>
      <?php switch ($module):
        case 'select_floor': ?>
        <li class="kn3 inf-it">
          <table class="inf-tl inf-coll" cellpadding="0" cellspacing="0"><tr><td class="inf-l"></td>
            <td class="inf-c">Выбор этажа</td>
          <td class="inf-r"></td></tr></table>
          <div class="inf-ct inf-hidden" id="pk">
            <table class="pb" cellpadding="0" cellspacing="0">
              <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
              <td class="content">
                <?php echo floor_select_helper($floors, null, true)?>
              </td>
              <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
            </table>
          </div>
        </li>
        <?php break; ?>
        <?php case 'personal_area': ?>
        <li class="kn4 inf-it">
          <table class="inf-tl inf-coll" cellpadding="0" cellspacing="0"><tr><td class="inf-l"></td>
            <td class="inf-c">Личный кабинет</td>
          <td class="inf-r"></td></tr></table>
          <div class="inf-ct inf-hidden" id="pk">
            <table class="pb" cellpadding="0" cellspacing="0">
              <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
              <td class="content">
                <?php include_component('pageParts', 'personalArea') ?>
              </td>
              <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
            </table>
          </div>
        </li>
        <?php break; ?>
        <?php case 'private_area': ?>
        <li class="kn4 inf-it">
          <table class="inf-tl inf-coll" cellpadding="0" cellspacing="0"><tr><td class="inf-l"></td>
            <td class="inf-c">Личный кабинет</td>
          <td class="inf-r"></td></tr></table>
          <div class="inf-ct inf-hidden" id="pk">
            <table class="pb" cellpadding="0" cellspacing="0">
              <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
              <td class="content">
                <?php include_component('pageParts', 'privateArea') ?>
              </td>
              <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
            </table>
          </div>
        </li>
        <?php break; ?>
        <?php case 'mini_cart': ?>
        <li class="kn4 inf-it">
          <table class="inf-tl inf-exp" cellpadding="0" cellspacing="0"><tr><td class="inf-l"></td>
            <td class="inf-c">Корзина</td>
          <td class="inf-r"></td></tr></table>
          <div class="inf-ct" style="display: block;">
            <table class="pb" cellpadding="0" cellspacing="0">
              <tr><td class="tlc"></td><td class="tb"></td><td class="trc"></td></tr><tr><td class="lb"></td>
              <td class="content">
                <?php include_component('pageParts', 'miniCart') ?>
              </td>
              <td class="rb"></td></tr><tr><td class="blc"></td><td class="bb"></td><td class="brc"></td></tr>
            </table>
          </div>
        </li>
        <?php break; ?>
      <?php endswitch; ?>
    <?php endforeach; ?>
  </ul>
</div><!-- #sr -->
