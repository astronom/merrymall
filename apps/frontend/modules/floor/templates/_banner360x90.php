<?php switch(rand(0, 4)):
  case 0: ?>
    <a href="<?php //echo url_for('@company?company_name=triline')?>">
      <img src="/images/adds/360x90_triline.jpg" width="360" height="90"/>
    </a>
    <?php break ?>
  <?php case 1 ?>
    <a href="<?php //echo url_for('@company?company_name=euroset')?>">
      <img src="/images/adds/360x90_euroset.jpg" width="360" height="90"/>
    </a>
    <?php break ?>
  <?php case 2 ?>
    <a href="<?php //echo url_for('@company?company_name=kinoplex')?>">
      <img src="/images/adds/360x90_kinopleks.jpg" width="360" height="90"/>
    </a>
    <?php break ?>
  <?php case 3 ?>
    <a href="<?php //echo url_for('@company?company_name=sportmaxi')?>">
      <img src="/images/adds/360x90_sport_maxi.jpg" width="360" height="90"/>
    </a>
    <?php break ?>
  <?php case 4 ?>
    <a href="<?php //echo url_for('@company?company_name=ssb')?>">
      <img src="/images/adds/360x90_ssb.jpg" width="360" height="90"/>
    </a>
    <?php break ?>
<?php endswitch ?>