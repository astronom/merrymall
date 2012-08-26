<div id="vert-fl-selector">
  <?php if (!$floor_is_top): ?>
  <a class="up" href="<?php echo url_for_floor($sf_request->getParameter('floor_id') + 1)?>"><img src="/images/floor/vert_selector_arror_up.png" alt="Вверх" title="Верх"></a>
  <?php endif; ?>
  <div class="cn"><?php echo $sf_request->getParameter('floor_id')?> этаж</div>
  <?php if (!$floor_is_bottom): ?>
  <a class="down" href="<?php echo url_for_floor($sf_request->getParameter('floor_id') - 1)?>"><img src="/images/floor/vert_selector_arror_down.png" alt="Вниз" title="Вниз"></a>
  <?php endif; ?>
</div>
