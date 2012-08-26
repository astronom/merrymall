<?php

/**
 * Processes the "anonymous customer" cookie.
 *
 * This filter should be added to the application filters.yml file **above**
 * the security filter:
 *
 *    anonymous_customer:
 *      class: amAnonymousCustomerFilter
 *
 *    security: ~
 *
 * @package    merrymall
 * @subpackage store
 * @author     Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: amAnonymousCustomerFilter 397 2010-09-28 14:53:33Z merrymall $
 */
class amAnonymousCustomerFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if (
    $this->isFirstCall()
    &&
    !$this->context->getUser()->isAuthenticated()
    )
    {
      $this->context->getUser()->signInAnonymous();
    }

    $filterChain->execute();
  }
}