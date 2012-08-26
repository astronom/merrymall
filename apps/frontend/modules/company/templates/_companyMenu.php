<div class="company-menu-l"></div>
<div class="company-menu-c">
  <ul class="company-menu-item">
  <?php if($company->isStore()):?>
    <li><a href="<?php echo url_for('company',$company)?>">Каталог</a></li>
    <li><a href="<?php echo url_for('company_about',$company)?>">О Магазине</a></li>
    <li><a href="<?php echo url_for('company_news',$company)?>">Новости</a></li>
    <li><a href="<?php echo url_for('company_actions',$company)?>">Акции</a></li>
    <li class="no-border"><a href="<?php echo url_for('company_contactus',$company)?>">Контакты</a></li>
  <?php elseif($company->isOffice()): ?>
    <li><a href="<?php echo url_for('company',$company)?>">Главная</a></li>
    <li><a href="<?php echo url_for('company_about',$company)?>">О Компании</a></li>
    <li><a href="<?php echo url_for('company_news',$company)?>">Новости</a></li>
    <li><a href="<?php echo url_for('company_actions',$company)?>">Акции</a></li>
    <li class="no-border"><a href="<?php echo url_for('company_contactus',$company)?>">Контакты</a></li>
  <?php endif; ?>
  </ul>
</div>
<div class="company-menu-r"></div>