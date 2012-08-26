<?php
use_helper('Tag','Number');

/**
 * Оформляет цену товара
 * @param decimal $value 				Цена товара из базы
 * @param boolean $ruble_symbol 		Использовать или нет символ рубля
 * @param boolean $show_null_pennies 	Показывать копейки
 * @param string $html_tag 				HTML tag оформления
 * @param string $css_class 			CSS class оформления
 * @return string
 */
function price($value, $ruble_symbol = false, $show_null_pennies = false, $html_tag = 'p', $css_class = 'price')
{
  //в каком виде выводит рубли
  $curency = $ruble_symbol ? '&nbsp;<span class="rur">p<span>уб.</span></span>' : '&nbsp;руб.';

  //Проверяем указано ли не выводить копейки
  if($show_null_pennies)
  {
    //@todo чет не выводит позиции после зяпятой
    $value = round($value, 2);
  }
  else {
    $value = round($value, 0);
  }
  $price = content_tag($html_tag, format_number($value).$curency, array( 'class' => $css_class ));

  return $price;
}
