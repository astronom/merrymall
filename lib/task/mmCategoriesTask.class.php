<?php

class mmCategoriesTaskTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
    new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
    new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
    new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'nestedset-categories';
    $this->briefDescription = 'reorganization of categories to NestedSet behavior';
    $this->detailedDescription = <<<EOF
reorganization of categories to NestedSet behavior
  [php symfony project:nestedset-categories|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $con = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    $categories = Doctrine::getTable('sCategory')->createQuery('c')
    ->where('c.parent_id IS NULL')
    ->execute();

    $rootCategory = new sCategory();
    $rootCategory->name = 'Root';
    $rootCategory->company_id = $category->getCompanyId();



    foreach ($categories as $category)
    {
      $this->log($category->getId());

      $newCategory = new ssCategory();
      $newCategory->name = $category->getName();
      $newCategory->company_id = $category->getCompanyId();
      $newCategory->save();

      //save as a root
        if ($newCategory->getNode()->isValidNode())
        {
          $newCategory->makeRoot($newCategory->getId());
          $newCategory->save();
        }
        else
        {
          $treeObject = Doctrine_Core::getTable('ssCategory')->getTree()->createRoot($newCategory); //calls $this->object->save internally
        }
      $this->getCategoriesTree($newCategory, $category->getCompanyId(), $category->getId());
    }
  }

  private function getCategoriesTree($category, $company_id, $parentId, $level = 1)
  {
      $subCategories = Doctrine::getTable('sCategory')->createQuery('c')
                                                      ->where('c.company_id = ?', $company_id)
                                                      ->andWhere('c.parent_id = ?', $parentId)
                                                      ->execute();
      foreach ($subCategories as $subCategory)
      {
        $this->log(str_repeat('-', $level).$subCategory->getId());

        $newSubCategory = new ssCategory();
        $newSubCategory->name = $subCategory->getName();
        $newSubCategory->company_id = $subCategory->getCompanyId();
        $newSubCategory->getNode()->insertAsLastChildOf($category);

        $this->getCategoriesTree($newSubCategory, $company_id, $subCategory->getId(), $level+1);
      }
  }
}
