<?php

require_once dirname(__FILE__).'/../lib/s_itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_itemGeneratorHelper.class.php';

/**
 * s_item actions.
 *
 * @package    merrymall
 * @subpackage s_item
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_itemActions extends autoS_itemActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->request->setParameter('company_id', $this->getUser()->getCompanyId());
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->s_item = $this->form->getObject();

    //форма для добавления - нужна по умолчанию
    $this->form->newItemVariantForm = new BackendsItemVariantForm();
    $this->form->itemVariantForms[] = new BackendsItemVariantForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->s_item = $this->form->getObject();

    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->s_item = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->s_item);

    //форма для добавления - нужна по умолчанию
    $this->form->newItemVariantForm = new BackendsItemVariantForm();

//    $properties = $this->s_item->getSProperties();
//    foreach($properties as $property)
//    {
//      $this->form->propertiesValuesForms[] = new ($itemVariant);
//    }

    $itemVariants = $this->s_item->getSItemVariants();

    foreach($itemVariants as $itemVariant)
    {
      $this->form->itemVariantForms[] = new BackendsItemVariantForm($itemVariant);
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->s_item = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->s_item);

    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $s_item = $form->save();

        Doctrine_Query::create()->delete('sItemVariant i')->where('i.item_id = ?', $s_item->getId())->execute();
        $parameters = $request->getParameter('s_item_variant');
        $itemVariant;
        foreach ($parameters as $parameter)
        {
          switch (key($parameter))
          {
            case 'name':
              if (isset($itemVariant))
                $itemVariant->save();
              $itemVariant = new sItemVariant();
              $itemVariant->setName(current($parameter));
              $itemVariant->setItemId($this->s_item->getId());
              $itemVariant->setCompanyId($this->s_item->getCompanyId());
              break;
            case 'price':
              $itemVariant->setPrice(current($parameter));
              break;
            case 'stock':
              $itemVariant->setStock(current($parameter));
              break;
            case 'is_main':
              $itemVariant->setIsMain( (current($parameter) == 'on') ? true : false);
              break;
          }
        }
        // Не забываем сохранить последнюю запись
        if (isset($itemVariant))
          $itemVariant->save();

        } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $s_item)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@s_item_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 's_item_edit', 'sf_subject' => $s_item));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

}
