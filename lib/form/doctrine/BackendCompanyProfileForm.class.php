<?php

/**
 * CompanyProfile form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendCompanyProfileForm extends BaseCompanyProfileForm
{
  public function configure()
  {
    unset(
      $this['created_at'],
      $this['updated_at']
    );
    $this->setWidgets(array(
      'description' => new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)),
      'news'        => new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)),
      'actions'     => new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)),
      'contacts'    => new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)),
    ));
  }
}
