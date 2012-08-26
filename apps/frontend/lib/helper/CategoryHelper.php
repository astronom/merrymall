<?php
function get_categories_tree($root = 0)
{
  return get_component('Company', 'categoriesTree', array());
}