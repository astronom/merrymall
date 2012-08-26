<div class="company-menu">
  <ul>
    <li class="company-info">Компания: <?php echo $company->getName(); ?></li>
    <li class="company-info">Id: <?php echo $company->getId(); ?></li>
    <li><?php echo link_to('Товары', 's_item/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Тексты', 's_office_text/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Варианты товаров', 's_item_variant/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Картинки', 's_image/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Свойства', 's_property/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Значения свойств', 's_property_value/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Бренды', 's_brand/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Категории', 's_category/index?company_id=' . $company->getId()); ?></li>
    <li><?php echo link_to('Загрузить прайс', 's_uploader/index?company_id=' . $company->getId()); ?></li>
  </ul>
  <br style="clear: left" />
</div>