<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div>
<?php endif; ?>
  <div id="treeChange" class="notice" style="display: none;">
  	Структура категорий была изменена.
  	<input id="saveTree" type="button" value="Сохранить изменения" />
  </div>
  
