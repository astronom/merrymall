<?php use_helper('I18N', 'Date') ?>
<?php include_partial('s_uploader/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Прайс '.$priceName, array(), 'messages') ?></h1>

  <?php include_partial('s_uploader/flashes') ?>

  <div id="sf_admin_content">
  	<h2>Найдены страницы:</h2>
  	<ol start="0">
	<?php foreach ($worksheets as $i => $worksheet):?>
	<?php echo link_to(content_tag('li', $worksheet),'yml_company_read', array('page_id' => $i, 'id' => $priceId)) ?>
	<?php endforeach;?>
	</ol>
<?php echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";?>
  </div>
  <div id="sf_admin_footer">
      <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  </div>
</div>