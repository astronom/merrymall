<?php

class CompanyTable extends Doctrine_Table
{
  public function retrieveBackendCompanyList(Doctrine_Query $q)
  {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.Floor f')->orderBy('f.id asc');
    return $q;
  }
  //Заменен на findAllAvailableLeftJoinFloor()
  public function findAllLeftJoinFloor()
  {
    $companies = $this->createQuery('c')
                      ->leftJoin('c.Floor f')
                      ->orderBy('c.position')
                      ->orderBy('f.position ASC')
                      ->execute();
    return $companies;
  }
  public function findAllAvailableLeftJoinFloor()
  {
  	$companies = $this->createQuery('c')
                      ->leftJoin('c.Floor f')
                      ->orderBy('c.position')
                      ->orderBy('f.position ASC')
                      ->where('c.type != "unavailable"')
                      ->execute();
    return $companies;

  }
  //Заменено на findAllAvailableByFloor
  public function findAllByFloor($floor_id)
  {
    $companies = $this->createQuery('c')
                      ->where('c.floor_id = ?', $floor_id)
                      ->orderBy('c.position')
                      ->execute();
    return $companies;
  }

  public function findAllAvailableByFloor($floor_id)
  {
    $companies = $this->createQuery('c')
                      ->where('c.floor_id = ?', $floor_id)
                      ->andWhere('c.type != "unavailable"')
                      ->orderBy('c.position')
                      ->execute();
    return $companies;
  }

  public function findOneByIdJoinFloor($company_id)
  {
    $company = $this->createQuery('c')
                    ->where('c.id = ?', $company_id)
                    ->leftJoin('c.Floor f')
                    ->fetchOne();
    return $company;
  }
  //В целях уменьшения запросов к бд заменено на findOneByUrlJoinFloorJoinCompanyProfile()
  public function findOneByUrlJoinFloor($company_url)
  {
    $company = $this->createQuery('c')
                    ->where('c.url = ?', $company_url)
                    ->leftJoin('c.Floor f')
                    ->fetchOne();
    return $company;
  }
  //Заменено на findOneAvailableByUrlJoinFloorJoinCompanyProfile()
  public function findOneByUrlJoinFloorJoinCompanyProfile($company_url)
  {
    $company = $this->createQuery('c')
                    ->where('c.url = ?', $company_url)
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p')
                    ->fetchOne();
    return $company;
  }

  public function findOneAvailableByUrlJoinFloorJoinCompanyProfile()
  {
    $company = $this->createQuery('c')
                    ->andWhere('c.type != "unavailable"')
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p')
                    ->fetchOne();
    return $company;
  }
  //Заменено на findAllJoinSCartJoinSItemVariantsJoinSItemJoinSImages()
  public function getWithCart($user_id) {

    $q = $this->createQuery('c')
              ->leftJoin('c.sCart s')
              ->leftJoin('s.sItemVariant i')
              //->leftJoin('i.sImage img')
              ->where('s.user_id = ?', $user_id)
              ->andWhere('s.order_id = 0');
    return $q->execute();
  }

  /**
   * Получает данные компаний, товары которых находятся в корзине пользователя
   * @param integer $user_id
   * @return Ambigous <Doctrine_Collection, mixed, PDOStatement, number, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown>
   */
  public function getCompaniesByUserCartQuery($user_id)
  {
    $q = $this->createQuery('c')
              ->leftJoin('c.Profile profile')
              ->leftJoin('c.sCart cart')
              ->where('cart.user_id = ?', $user_id)
              ->andWhere('cart.order_id = 0');
    return $q;

  }

  public function findAllJoinSCartJoinSItemVariantsJoinSItemJoinSImages($user_id) {

    $q = $this->createQuery('c')
              ->leftJoin('c.sCart s')
              ->leftJoin('s.sItemVariant iV')
              ->leftJoin('iV.sItem i')
              ->leftJoin('i.sImages')
              ->where('s.user_id = ?', $user_id)
              ->andWhere('s.order_id = 0');
    return $q->execute();
  }
  //Заменено на getRandomAvailableCompanies()
  public function getRandomCompanies($limit = 5)
  {
    $q = $this->createQuery('c')
              ->orderBy('RAND()')
              ->limit($limit);
    return $q->execute();

  }
  public function findRandomAvailableCompanies($limit = 5)
  {
  	$q = $this->createQuery('c')
  	          ->where('c.type != "unavailable"')
              ->orderBy('RAND()')
              ->limit($limit);
    return $q->execute();
  }

  public function getAvailableJoinFloorJoinCompanyProfile($requestParams)
  {

    $company = $this->createQuery('c')
                    ->where('c.url = ?', $requestParams['url'])
                    ->andWhere('c.type = ?', $requestParams['type'])
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p');

    return $company->execute();

  }

  public function getAvailableJoinFloorJoinCompanyProfileJoinNews($requestParams)
  {

    $company = $this->createQuery('c')
                    ->where('c.url = ?', $requestParams['url'])
                    ->andWhere('c.type = ?', $requestParams['type'])
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p')
                    ->leftJoin('c.News n');

    return $company->execute();

  }
  public function getAvailableJoinFloorJoinCompanyProfileJoinActions($requestParams)
  {
    $company = $this->createQuery('c')
                    ->where('c.url = ?', $requestParams['company_name'])
                    ->andWhere('c.type = ?', $requestParams['type'])
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p')
                    ->leftJoin('c.Actions a');

    return $company->execute();

  }

  public function getAvailableJoinFloorJoinCompanyProfileJoinOfficeTexts($requestParams)
  {
    $company = $this->createQuery('c')
                    ->where('c.url = ?', $requestParams['company_name'])
                    ->andWhere('c.type = ?', $requestParams['type'])
                    ->andWhere('oft.title_slug = ?', $requestParams['slug'])
                    ->leftJoin('c.Floor f')
                    ->leftJoin('c.Profile p')
                    ->leftJoin('c.sOfficeText oft');

    return $company->execute();

  }
}
