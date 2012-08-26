<?php

/**
 * signin actions.
 *
 * @package    merrymall
 * @subpackage signin
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class signinActions extends sfActions
{
  /**
   * Executes signin action
   *
   * @param sfRequest $request A request object
   */
  public function executeSignin(sfWebRequest $request)
  {
    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->form = new $class();

    $this->form->bind($request->getParameter('signin'));
    if ($this->form->isValid())
    {
      $values = $this->form->getValues();

      $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

      if($request->isXmlHttpRequest())
      {
        return $this->returnJSON(array('success' => true, 'user' => $this->getComponent('pageParts', 'privateArea', array('referer' => $request->getReferer()))));
      }
      // redirect to referer
      $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $request->getReferer($request->getReferer()));
      return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');

    }
    else
    {
      if($request->isXmlHttpRequest())
      {
        $output = array("success" => false);
        foreach ($this->form->getFormFieldSchema() as $name => $formField)
        {
          if(($error_name = $formField->getError()) !=NULL)
          {
            $output[sprintf($this->form->getWidgetSchema()->getNameFormat(),$name)] = addcslashes($error_name,'"');
          }
        }
        return $this->returnJSON($output);
      }
    }
  }
  public function executeRegister(sfWebRequest $request)
  {
    // если пользователь авторизован -
    // шлем нафиг (на хоумпэйдж)
    $user = $this->getUser();
    if ($user->isAuthenticated()
    &&
    !$user->hasCredential(array('anonymous')))
    {
      if($request->isXmlHttpRequest())
      {
        return $this->renderText('Вы уже авторазованы на сайте');
      }

      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_guard_plugin_register_form', 'sfGuardFormRegister');
    $this->form = new $class();

    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('registrationForm',array('form' => $this->form));
    }
  }
  private function returnJSON($output)
  {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($output));
  }
}
