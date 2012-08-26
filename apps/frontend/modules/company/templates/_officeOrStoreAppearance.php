<?php if($companyType == 'store'):?>
<td class="mn2">
  <div class="mag1"><div class="mag2"><div class="mag3"><div class="mag7">
  <div class="mag4"><div class="mag5"><div class="mag6"><div class="mag8">
    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
      <img title="Merry Mall" alt="Merry Mall" src="/images/logo2.gif" width="130" height="96"/>
    </a>
  <div class="store-logo"><?php echo image_tag($companyLogo) ?></div>
  </div></div></div></div></div></div></div></div>
</td>
<?php elseif($companyType == 'office'):?>
<td class="mn2kab">
  <div class="kab1"><div class="kab2"><div class="kab3"><div class="kab7">
  <div class="kab4"><div class="kab5"><div class="kab6"><div class="kab8">
    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
      <img title="Merry Mall" alt="Merry Mall" src="/images/logo2.gif" width="130" height="96"/>
    </a>
  <div class="store-logo"><?php echo image_tag($companyLogo) ?></div>
  </div></div></div></div></div></div></div></div>
</td>
<?php endif;?>