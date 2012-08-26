<?php

/**
 * sBrand filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsBrandFormFilter extends BasesBrandFormFilter
{
  public function configure()
  {
    parent::configure();

    $request = sfContext::getInstance()->getRequest();

    unset($this->widgetSchema['company_id']);
  }
}
