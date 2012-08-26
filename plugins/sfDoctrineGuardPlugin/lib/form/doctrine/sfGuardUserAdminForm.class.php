<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    parent::configure();

    $profileForm = new sfGuardUserProfileForm($this->object->Profile);
    unset(
      $profileForm['id'],
      $profileForm['user_id'],
      $profileForm['created_at'],
      $profileForm['updated_at']
    );
    $this->embedForm('Profile', $profileForm);
  }
}
