<?php

/**
 * sBrand form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsBrandForm extends BasesBrandForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['company_id']
    );

    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($this->request->getAttribute('company_id'));
  }
}
