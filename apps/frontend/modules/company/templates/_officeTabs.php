<div class="vis" id="c-catalog">
  <h1>Каталог</h1>
  <p>Каталог офиса</p>
</div>
<div class="hid" id="c-description">
  <h1>О компании</h1>
  <p><?php echo $profile->getDescription(ESC_RAW); ?></p>
</div>
<div class="hid" id="c-contacts">
  <h1>Контакты</h1>
  <p><?php echo $profile->getContacts(ESC_RAW); ?></p>
</div>
<div class="hid" id="c-news">
  <h1>Новости</h1>
  <p><?php echo $profile->getNews(ESC_RAW); ?></p>
</div>
<div class="hid" id="c-actions">
  <h1>Акции</h1>
  <p><?php echo $profile->getActions(ESC_RAW); ?></p>
</div>