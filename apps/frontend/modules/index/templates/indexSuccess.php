<div id="building-container">
    <?php include_partial('index/buildingLayer', array('floors' => $floors, 'news' => $news)) ?>
</div><!-- #building-layer -->

<div id="sl" class="sidebar">
  <div id="logo">
    <a href="<?php echo url_for('@homepage', true) ?>">
      <img title="Merry Mall" alt="Merry Mall" src="/images/logo1.png" width="226" height="140"/>
    </a>
  </div>
</div><!-- #sl -->

<?php include_partial('pageParts/rigthSideBar', array('floors' => $floors, 'modules' => array('select_floor','private_area')) ) ?>
<?php include_partial('pageParts/windowPopup')?>

<div id="header">
  <table style="width: 100%"><tr><td>&nbsp;</td><td style="width: 1000px;"><?php include_partial('pageParts/header') ?></td><td>&nbsp;</td></tr></table>
</div><!-- #header-->