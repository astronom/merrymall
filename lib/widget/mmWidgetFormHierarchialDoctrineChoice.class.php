<?php

class mmWidgetFormHierarchialDoctrineChoice extends sfWidgetFormDoctrineChoice
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('parent_method', 'getParentId');
    $this->addOption('root_parent_value', NULL);

    parent::configure($options, $attributes);
  }

  /**
   * Returns the choices associated to the model.
   *
   * @return array An array of choices
   */
  public function getChoices()
  {
    $choices = array();
    if (false !== $this->getOption('add_empty'))
    {
      $choices[''] = true === $this->getOption('add_empty') ? '' : $this->getOption('add_empty');
    }

    if (null === $this->getOption('table_method'))
    {
      $query = null === $this->getOption('query') ? Doctrine_Core::getTable($this->getOption('model'))->createQuery() : $this->getOption('query');
      if ($order = $this->getOption('order_by'))
      {
        $query->addOrderBy($order[0] . ' ' . $order[1]);
      }
      $objects = $query->execute();
    }
    else
    {
      $tableMethod = $this->getOption('table_method');
      $results = Doctrine_Core::getTable($this->getOption('model'))->$tableMethod();

      if ($results instanceof Doctrine_Query)
      {
        $objects = $results->execute();
      }
      else if ($results instanceof Doctrine_Collection)
      {
        $objects = $results;
      }
      else if ($results instanceof Doctrine_Record)
      {
        $objects = new Doctrine_Collection($this->getOption('model'));
        $objects[] = $results;
      }
      else
      {
        $objects = array();
      }
    }

    $choices += $this->getChoicesTree(
                                      $objects,
                                      $this->getOption('method'),
                                      $this->getOption('key_method'),
                                      $this->getOption('parent_method'),
                                      $this->getOption('root_parent_value')
                                     );
    return $choices;
  }

  private function getChoicesTree($objects, $method, $keyMethod, $parentMethod, $parent, $level = 0, $tabber = '&nbsp;&nbsp;')
  {
    $choices = array();
    foreach ($objects as $key => $object)
      if ($object->$parentMethod() == $parent)
      {
        $choices[$object->$keyMethod()] = str_repeat($tabber, $level) . $object->$method();
        unset($objects[$key]);
        $choices += $this->getChoicesTree($objects, $method, $keyMethod, $parentMethod, $object->$keyMethod(), $level+1);
      }
    return $choices;
  }
}