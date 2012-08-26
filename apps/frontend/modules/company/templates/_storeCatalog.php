<?php if (isset($categoriesTree)):?>
  <?php echo $sf_data->getRaw('categoriesTree')?>
<?php else:?>
  <ul>
    <li><a href="#">Категория 1</a>
      <ul>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
      </ul>
    </li>
    <li><a href="#">Категория 1</a>
      <ul>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
      </ul>
    </li>
    <li><a href="#">Категория 1</a>
      <ul>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
        <li><a href="#">Подкатегория</a></li>
      </ul>
    </li>
  </ul>
<?php endif?>