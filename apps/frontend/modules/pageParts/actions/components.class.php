<?php
class pagePartsComponents extends sfComponents
{
  public function executeHeader()
  {

  }

  public function executeRigthSideBar()
  {

  }

  public function executePrivateArea(sfWebRequest $request)
  {
    if($this->getVar('form'))
    {
      $this->form = $this->getVar('form');
    }
    else
    {
      $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
      $this->form = new $class();
    }
    $this->userCssClass = '';
    if($request->getParameter('module')=='company'
       || preg_match('/(company)/',$this->getVar('referer')))
    {
     $this->userCssClass = '-company';
    }
  }

  public function executeMiniCart()
  {
    $this->companies = Doctrine::getTable('Company')->getWithCart($this->getUser()->getAttribute('user_id','','sfGuardSecurityUser'));
    $this->companies_count = count($this->companies->toArray());
    $this->cart_items_count = Doctrine::getTable('sCart')->getAllByUserIdNotOrderedQuery($this->getUser()->getAttribute('user_id','','sfGuardSecurityUser'))->count();
    if($this->cart_items_count==0) $this->cart_items_count = '';
  }

  public function executeWindowPopup()
  {

  }

  public function executeChat()
  {
    $this->customersPhone = $this->getVar('phone') ? $this->getVar('phone') : '';
    $this->company_id = $this->getVar('company_id');
  }

  public function executeInitChat()
  {
    return $this->renderText('Success');
  }

  public function executeMiniCart_()
  {
    $this->customersPhone = 'Требует определения';
  }

  public function executeFooter()
  {
    //Узнаем какие еще компании находятся на этаже
    $this->shopsOnFloorList = Doctrine::getTable('Company')->findAllAvailableByFloor($this->getVar('floor_id'));
    //Получаем случайный список компании, лимит по умолчанию 5
    $this->shopsRandomList = Doctrine::getTable('Company')->findRandomAvailableCompanies();

  }
}