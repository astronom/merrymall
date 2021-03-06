<?php use_helper('I18N', 'Date') ?>
<?php include_partial('s_category/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('S category List', array(), 'messages') ?></h1>

  <?php include_partial('s_category/flashes') ?>

  <div id="sf_admin_header">
    <?php //include_partial('s_category/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <form action="<?php echo url_for('s_category_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('s_category/list', array('treeObject' => $treeObject, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('s_category/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('s_category/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php //include_partial('s_category/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
