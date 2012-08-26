<?php

require_once dirname(__FILE__).'/../lib/s_orderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_orderGeneratorHelper.class.php';

/**
 * s_order actions.
 *
 * @package    merrymall
 * @subpackage s_order
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_orderActions extends autoS_orderActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->request->setParameter('company_id', $this->getUser()->getCompanyId());

  }

  protected function buildQuery()
  {
    $query = parent::buildQuery();
    $query->Where('c.company_id = ?', $this->request->getParameter('company_id'))
          ->andWhere('order_id > 0');
    return $query;
  }

  public function executeListOrdered(sfWebRequest $request)
  {
    $s_order = $this->getRoute()->getObject();
    $s_order->getSCompanyOrder($this->request->getParameter('company_id'))->setStatus('ordered')->save();

    //$this->user = 'asda';

    $this->getUser()->setFlash('notice','Выбранный заказ обработан');
    $this->redirect('s_order');
  }

  //эммм, подумаем:))
  public function executeListDeleteDeliveredOrders(sfWebRequest $request)
  {
    $delivered_orders = Doctrine::getTable('sOrder')->cleanup($request->getParameter('company_id'));

    if($delivered_orders)
    {
      $this->getUser()->setFlash('notice', sprintf("%d отправленных заказа были удалены из базы.",$delivered_orders));
    }
    else
    {
      $this->getUser()->setFlash('notice', 'Нет доставленных заказов для удаления');
    }

    $this->redirect('s_order');
  }
}
