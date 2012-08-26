<?php

/**
 * sPropertyValue filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sPropertyValueFormFilter extends BasesPropertyValueFormFilter
{
  public function configure()
  {
    $query = Doctrine_Query::create()
        ->from('sProperty p')
        ->where('p.company_id = ?', 1);


    $this->widgetSchema['property_id']->setOption('query', $query);
  }
}
