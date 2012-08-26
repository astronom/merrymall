<?php

/**
 * sCategory filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsCategoryFormFilter extends BasesCategoryFormFilter
{
  public function configure()
  {
    parent::configure();

    //$request = sfContext::getInstance()->getRequest();

    //$categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    //$this->widgetSchema['parent_id']->setOption('query', $categoryQuery);

    unset($this->widgetSchema['company_id']);
  }
}
