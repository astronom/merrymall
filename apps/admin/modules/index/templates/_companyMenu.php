<div class="company-menu">
  <ul>
    <li class="company-info">Компания: <?php echo $company->getName(); ?></li>
    <li><?php echo link_to('Товары', 's_item'); ?></li>
    <li><?php echo link_to('Варианты товаров', 's_item_variant'); ?></li>
    <li><?php echo link_to('Картинки', 's_image'); ?></li>
    <li><?php echo link_to('Свойства', 's_property'); ?></li>
    <li><?php echo link_to('Значения свойств', 's_property_value'); ?></li>
    <li><?php echo link_to('Бренды', 's_brand'); ?></li>
    <!-- <li><?php echo link_to('Категории', 's_category'); ?></li>  -->
    <li><?php echo link_to('Заказы', 's_order'); ?></li>
    <li><?php echo link_to('Перейти к магазину', '/company/'.$company->getUrl()); ?></li>
    <li><?php echo link_to('Выйти', 'sf_guard_signout'); ?></li>
  </ul>
  <br style="clear: left" />
</div>