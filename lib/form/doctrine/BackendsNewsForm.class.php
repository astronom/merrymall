<?php
/**
 * Backend News form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsNewsForm extends BaseNewsForm
{
  public function configure()
  {
    unset(
    $this['created_at'],
    $this['updated_at'],
    $this['title_slug']
    );

    $this->setWidget('text', new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)));
    $this->setWidget('date', new mmWidgetFormJQueryToolsDateInput());
  }
}