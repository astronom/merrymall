<?php

/**
 * s_item module helper.
 *
 * @package    merrymall
 * @subpackage s_item
 * @author     Wronglink
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_itemGeneratorHelper extends BaseS_itemGeneratorHelper
{
  public function getArrayValue($array, $key)
  {
    return $array[$key];
  }
}
