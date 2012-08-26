<?php use_helper('I18N', 'Date') ?>
<?php include_partial('s_uploader/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Прайс '.$priceName.' страница '.$worksheet->getTitle(), array(), 'messages') ?></h1>

  <?php include_partial('s_uploader/flashes') ?>

  <div id="sf_admin_content">
  <?php include_partial('readTable', array('worksheet' => $worksheet, 'countColumns' => $countColumns ))?>
  <?php echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";?>
  </div>
  <div id="sf_admin_footer">
      <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  </div>
</div>