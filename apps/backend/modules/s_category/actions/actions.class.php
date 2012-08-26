<?php

require_once dirname(__FILE__).'/../lib/s_categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_categoryGeneratorHelper.class.php';

/**
 * s_category actions.
 *
 * @package    merrymall
 * @subpackage s_category
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_categoryActions extends autoS_categoryActions
{
  public function preExecute()
  {
    parent::preExecute();
    $routing = $this->getContext()->getRouting();
    $routing->setDefaultParameter('company_id', $this->request->getParameter('company_id'));
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->select('*');
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }

  protected function addSortQuery($query)
  {
    //don't allow sorting; always sort by tree and lft
    //$query->addOrderBy('root_id, lft');
    $query->addOrderBy('root_id asc');
    $query->addOrderBy('lft asc');

  }

  public function executeBatch(sfWebRequest $request)
  {
    if ("batchOrder" == $request->getParameter('batch_action'))
    {
      return $this->executeBatchOrder($request);
    }

    parent::executeBatch($request);
  }

  public function executeIndex(sfWebRequest $request)
  {

    $q = Doctrine_Query::create()
    ->select('*')
    ->from('sCategory c')
    ->andWhere('c.company_id = ?', $this->request->getParameter('company_id'));
    $treeObject = Doctrine_Core::getTable('sCategory')->getTree();
    $treeObject->setBaseQuery($q);
    $this->treeObject = $treeObject;

    //$this->sort = $this->getSort();
  }

  /**
   * Изменяет последовательность категорий
   * @param sfWebRequest $request
   */
  public function executeBatchOrder(sfWebRequest $request)
  {
    $newparent = $request->getParameter('newparent');

    //manually validate newparent parameter

    //make list of all ids
    $ids = array();
    foreach ($newparent as $key => $val)
    {
      $ids[$key] = true;
      if (!empty($val))
        $ids[$val] = true;
    }
    $ids = array_keys($ids);

    //validate if all id's exist
    $validator = new sfValidatorDoctrineChoice(array('model' => 'sCategory', 'multiple' => true));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // the id's validate, now update the tree
      $count = 0;
      $flash = "";

      foreach ($newparent as $id => $parentId)
      {
        if (!empty($parentId))
        {
          $node = Doctrine::getTable('sCategory')->find($id);
          $parent = Doctrine::getTable('sCategory')->find($parentId);

          if (!$parent->getNode()->isDescendantOfOrEqualTo($node))
          {
            $node->getNode()->moveAsFirstChildOf($parent);
            $node->save();

            $count++;

            $flash .= "<br/>Moved '".$node['name']."' under '".$parent['name']."'.";
          }
        }
      }

      if ($count > 0)
      {
        $this->getUser()->setFlash('notice', sprintf("Tree order updated, moved %s item%s:".$flash, $count, ($count > 1 ? 's' : '')));
      }
      else
      {
        $this->getUser()->setFlash('error', "You must at least move one item to update the tree order");
      }
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'Cannot update the tree order, maybe some item are deleted, try again');
    }

    $this->redirect('@s_category');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $object = $this->getRoute()->getObject();
    if ($object->getNode()->isValidNode())
    {
      $object->getNode()->delete();
    }
    else
    {
      $object->delete();
    }

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@s_category');
  }


  /**
   * Создает новую категорию относительно родителя
   * @param sfWebRequest $request
   */
  public function executeListNew(sfWebRequest $request)
  {
    $this->executeNew($request);
    $this->form->setDefault('parent_id', $request->getParameter('id'));
    $this->form->setDefault('company_id', $request->getParameter('company_id'));
    $this->setTemplate('edit');
  }


  /**
   * Редактируем товары категории
   * @param sfWebRequest $request
   */
  public function executeListEditItems(sfWebRequest $request)
  {

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');

      $tree = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $tree)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');

        //$this->redirect('@tree_new');
      }
      else
      {
        //$this->redirect('@tree_edit?id='.$tree['id']);
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
    }
  }
}
