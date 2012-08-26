<?php
class companyComponents extends sfComponents
{

  public function executeCategoriesTree()
  {
    $this->treeObject = Doctrine_Core::getTable('ssCategory')->getTree();
    $this->rootColumnName = $this->treeObject->getAttribute('rootColumnName');
  }

  private function getTree($rootId = null){
    $tree = Doctrine_Core::getTable('ssCategory')->getTree();
    $options = array();
    if($rootId !== null)
    {
      $options['root_id'] = $rootId;
    }
    return $tree->fetchTree($options);
  }

  private function getRoots(){
    $tree = Doctrine_Core::getTable('ssCategory')->getTree();
    return $tree->fetchRoots();
  }
}
