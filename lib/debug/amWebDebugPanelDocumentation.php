<?php

/**
 * Documentation Web Debug Panel
 * 
 * @package     amWebDebug
 * @subpackage  debug
 * @author      Ryan Weaver <ryan@thatsquality.com>, Astronom <a.manichev@gmail.com>
 * @since       2009-10-25
 * @update     2010-08-27
 * @version     svn:$Id$ $Author$
 */
class amWebDebugPanelDocumentation extends sfWebDebugPanel
{
  
  public static function listenToLoadDebugWebPanelEvent(sfEvent $event)
  {
    $event->getSubject()->setPanel(
    	'documentation',
      new self($event->getSubject())
    );
  }  

  /**
   * @see sfWebDebugPanel
   */
  public function getTitle()
  {
    return '<img src="/images/debug/documentation.png" alt="Documentation Shortcuts" height="16" width="16" /> docs';
  }

  /**
   * @see sfWebDebugPanel
   */
  public function getPanelTitle()
  {
    return 'Документация - Книги по Symfony FW и Doctrine ORM';
  }
  
  /**
   * @see sfWebDebugPanel
   */
  public function getPanelContent()
  {
    return sprintf(
      '<table>
        <tbody>
          <tr>
            <td>%s</td>
            <td width="50">&nbsp;</td>
            <td>%s</td>
            <td width="50">&nbsp;</td>
            <td>%s</td>
            <td width="50">&nbsp;</td>
            <td>%s</td>
          </tr>
        </tbody>
      </table>',
      $this->getBookContent('Practical Symfony', $this->practicalSymfonyChapters, 'am_practical_symfony'),
      $this->getBookContent('More with symfony', $this->moreWithSymfonyChapters, 'am_more_with_symfony'),
      $this->getBookContent('The symfony Reference Book', $this->referenceGuide, 'am_reference_guide'),
      $this->getBookContent('Doctrine ORM for PHP', $this->doctrineBook, 'am_doctrine')
    );
  }
  
  /**
   * Returns the content that outlines a specific book
   * 
   * @param   string  $title      The title of the book we're highlighting
   * @param   array   $chapters   An array of chapter titles and urls
   * 
   * @return  string
   */
  protected function getBookContent($title, $chapters, $domId)
  {
    $content = sprintf('<h3>%s %s</h3>', $title, $this->getToggler($domId, $title));
    
    $chptContent = '';
    foreach($chapters as $chapter => $url)
    {
      $chptContent .= sprintf('<li><a href="%s" title="Read %s" target="_blank">%s</a></li>', $url, $chapter, $chapter);
    }
    $content .= sprintf('
      <style type="text/css">
        #%s { list-style-type: none; }
        #%s li { margin: 0 }
        #%s a:hover { text-decoration: underline; }
      </style>
      <ul id="%s" style="display: none; ">%s</ul>',
      $domId,
      $domId,
      $domId,
      $domId,
      $chptContent
    );
    
    return $content;
  }

  protected $practicalSymfonyChapters = array(
    'Глава 1 - Начало проекта'                         => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/01',
    'Глава 2 - Собственно проект'                      => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/02',
    'Глава 3 - Модель данных'                          => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/03',
    'Глава 4 - Вид и контроллер'                       => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/04',
    'Глава 5 - Маршрутизация'                          => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/05',
    'Глава 6 - Модель в подробностях'                  => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/06',
    'Глава 7 - Категории'                              => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/07',
    'Глава 8 - Модульное тестирование'                 => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/08',
    'Глава 9 - Функциональное тестирование'            => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/09',
    'Глава 10 - Формы'                                 => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/10',
    'Глава 11 - Тестирование форм'                     => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/11',
    'Глава 12 - Генератор админки'                     => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/12',
    'Глава 13 - Пользователь'                          => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/13',
    'Глава 14 - Ленты'                                 => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/14',
    'Глава 15 - Веб-сервисы'                           => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/15',
    'Глава 16 - Почта'                                 => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/16',
    'Глава 17 - Поиск'                                 => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/17',
    'Глава 18 - AJAX'                                  => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/18',
    'Глава 19 - Интернационализация и Локализация'     => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/19',
  	'Глава 20 - Плагины'                               => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/20',
  	'Глава 21 - Кэш'                                   => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/21',
    'Глава 22 - Развертывание приложения (deployment)' => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/22',
    'Глава 23 - Другой взгляд на Symfony'              => 'http://www.symfony-project.org/jobeet/1_4/Doctrine/ru/23',
  
  );
  
  protected $moreWithSymfonyChapters = array(
    'Day 1 - Introduction'                      => 'http://www.symfony-project.org/advent_calendar/1/en',
    'Day 2 - Advanced Routing (part 1)'         => 'http://www.symfony-project.org/advent_calendar/2/en',
    'Day 3 - Advanced Routing (part 2)'         => 'http://www.symfony-project.org/advent_calendar/3/en',
    'Day 4 - Enhance your Productivity'         => 'http://www.symfony-project.org/advent_calendar/4/en',
    'Day 5 - Emails (part 1)'                   => 'http://www.symfony-project.org/advent_calendar/5/en',
    'Day 6 - Emails (part 2)'                   => 'http://www.symfony-project.org/advent_calendar/6/en',
    'Day 7 - Custom Widgets and Validators'     => 'http://www.symfony-project.org/advent_calendar/7/en',
    'Day 8 - Advanced Forms (part 1)'           => 'http://www.symfony-project.org/advent_calendar/8/en',
    'Day 9 - Advanced Forms (part 2)'           => 'http://www.symfony-project.org/advent_calendar/9/en',
    'Day 10 - Extending the Web Debug Toolbar'  => 'http://www.symfony-project.org/advent_calendar/10/en',
    'Day 11 - Advanced Doctrine Usage (part 1)' => 'http://www.symfony-project.org/advent_calendar/11/en',
    'Day 12 - Advanced Doctrine Usage (part 2)' => 'http://www.symfony-project.org/advent_calendar/12/en',
    'Day 13 - The Lazy Day'                     => 'http://www.symfony-project.org/advent_calendar/13/en',
    'Day 14 - Taking Advantage of Doctrine Table Inheritance (part 1)' => 'http://www.symfony-project.org/advent_calendar/14/en',
    'Day 15 - Taking Advantage of Doctrine Table Inheritance (part 2)' => 'http://www.symfony-project.org/advent_calendar/15/en',
    'Day 16 - Symfony Internals'                => 'http://www.symfony-project.org/advent_calendar/16/en',
    'Day 17 - Windows and symfony'              => 'http://www.symfony-project.org/advent_calendar/17/en',
    'Day 18 - Developing for Facebook (part 1)' => 'http://www.symfony-project.org/advent_calendar/18/en',
    'Day 19 - Developing for Facebook (part 2)' => 'http://www.symfony-project.org/advent_calendar/19/en',
    'Day 20 - Leveraging the Power of the Command Line (part 1)' => 'http://www.symfony-project.org/advent_calendar/20/en',
    'Day 21 - Leveraging the Power of the Command Line (part 2)' => 'http://www.symfony-project.org/advent_calendar/21/en',
    'Day 22 - Playing with symfony\'s Config Cache (part 1)' => 'http://www.symfony-project.org/advent_calendar/22/en',
    'Day 23 - Playing with symfony\'s Config Cache (part 2)' => 'http://www.symfony-project.org/advent_calendar/23/en',
    'Day 24 - Working with the symfony Community' => 'http://www.symfony-project.org/advent_calendar/24/en',
  );
  
  protected $referenceGuide = array(
    'Глава 1 - Introduction'                          => 'http://www.symfony-project.org/reference/1_4/en/01-Introduction',
    'Глава 2 - The YAML Format'                       => 'http://www.symfony-project.org/reference/1_4/en/02-YAML',
    'Глава 3 - Configuration File Principles'         => 'http://www.symfony-project.org/reference/1_4/en/03-Configuration-Files-Principles',
    'Глава 4 - The settings.yml Configuration File'   => 'http://www.symfony-project.org/reference/1_4/en/04-Settings',
    'Глава 5 - The factories.yml Configuration File'  => 'http://www.symfony-project.org/reference/1_4/en/05-Factories',
    'Глава 6 - The generator.yml Configuration File'  => 'http://www.symfony-project.org/reference/1_4/en/06-Admin-Generator',
    'Глава 7 - The databases.yml Configuration File'  => 'http://www.symfony-project.org/reference/1_4/en/07-Databases',
    'Глава 8 - The security.yml Configuration File'   => 'http://www.symfony-project.org/reference/1_4/en/08-Security',
    'Глава 9 - The cache.yml Configuration File'      => 'http://www.symfony-project.org/reference/1_4/en/09-Cache',
    'Глава 10 - The routing.yml Configuration File'   => 'http://www.symfony-project.org/reference/1_4/en/10-Routing',
    'Глава 11 - The app.yml Configuration File'       => 'http://www.symfony-project.org/reference/1_4/en/11-App',
    'Глава 12 - The filters.yml Configuration File'   => 'http://www.symfony-project.org/reference/1_4/en/12-Filters',
    'Глава 13 - The view.yml Configuration File'      => 'http://www.symfony-project.org/reference/1_4/en/13-View',
    'Глава 14 - Other Configuration Files'            => 'http://www.symfony-project.org/reference/1_4/en/14-Other-Configuration-Files',
    'Глава 15 - Events'                               => 'http://www.symfony-project.org/reference/1_4/en/15-Events',
    'Глава 16 - Tasks'                                => 'http://www.symfony-project.org/reference/1_4/en/16-Tasks',
    'Appendix A - License'                              => 'http://www.symfony-project.org/reference/1_4/en/A-License',
  );
  
  protected $doctrineBook = array(
    'Глава 1 - Introduction'                  => 'http://www.doctrine-project.org/documentation/manual/1_2/en/introduction',
    'Глава 2 - Getting Started'               => 'http://www.doctrine-project.org/documentation/manual/1_2/en/getting-started',
    'Глава 3 - Introduction to Connections'   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/introduction-to-connections',
    'Глава 4 - Configuration'                 => 'http://www.doctrine-project.org/documentation/manual/1_2/en/configuration',
    'Глава 5 - Connections'                   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/connections',
    'Глава 6 - Introduction to Models'        => 'http://www.doctrine-project.org/documentation/manual/1_2/en/introduction-to-models',
    'Глава 7 - Defining Models'               => 'http://www.doctrine-project.org/documentation/manual/1_2/en/defining-models',
    'Глава 8 - Working with Models'           => 'http://www.doctrine-project.org/documentation/manual/1_2/en/working-with-models',
    'Глава 9 - DQL (Doctrine Query Language)' => 'http://www.doctrine-project.org/documentation/manual/1_2/en/dql-doctrine-query-language',
    'Глава 10 - Component Overview'           => 'http://www.doctrine-project.org/documentation/manual/1_2/en/component-overview',
    'Глава 11 - Native SQL'                   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/native-sql',
    'Глава 12 - YAML Schema Files'            => 'http://www.doctrine-project.org/documentation/manual/1_2/en/yaml-schema-files',
    'Глава 13 - Data Validation'              => 'http://www.doctrine-project.org/documentation/manual/1_2/en/data-validation',
    'Глава 14 - Data Hydrators'               => 'http://www.doctrine-project.org/documentation/manual/1_2/en/data-hydrators',
    'Глава 15 - Inheritance'                  => 'http://www.doctrine-project.org/documentation/manual/1_2/en/inheritance',
    'Глава 16 - Behaviors'                    => 'http://www.doctrine-project.org/documentation/manual/1_2/en/behaviors',
    'Глава 17 - Searching'                    => 'http://www.doctrine-project.org/documentation/manual/1_2/en/searching',
    'Глава 18 - Hierarchical Data'            => 'http://www.doctrine-project.org/documentation/manual/1_2/en/hierarchical-data',
    'Глава 19 - Data Fixtures'                => 'http://www.doctrine-project.org/documentation/manual/1_2/en/data-fixtures',
    'Глава 20 - Database Abstraction Layer'   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/database-abstraction-layer',
    'Глава 21 - Transactions'                 => 'http://www.doctrine-project.org/documentation/manual/1_2/en/transactions',
    'Глава 22 - Event Listeners'              => 'http://www.doctrine-project.org/documentation/manual/1_2/en/event-listeners',
    'Глава 23 - Caching'                      => 'http://www.doctrine-project.org/documentation/manual/1_2/en/caching',
    'Глава 24 - Migrations'                   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/migrations',
    'Глава 25 - Extensions'                   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/extensions',
    'Глава 26 - Utilities'                    => 'http://www.doctrine-project.org/documentation/manual/1_2/en/utilities',
    'Глава 27 - Unit Testing'                 => 'http://www.doctrine-project.org/documentation/manual/1_2/en/unit-testing',
    'Глава 28 - Improving Performance'        => 'http://www.doctrine-project.org/documentation/manual/1_2/en/improving-performance',
    'Глава 29 - Technology'                   => 'http://www.doctrine-project.org/documentation/manual/1_2/en/technology',
    'Глава 30 - Exceptions and Warnings'      => 'http://www.doctrine-project.org/documentation/manual/1_2/en/exceptions-and-warnings',
    'Глава 31 - Real World Examples'          => 'http://www.doctrine-project.org/documentation/manual/1_2/en/real-world-examples',
    'Глава 32 - Coding Standards'             => 'http://www.doctrine-project.org/documentation/manual/1_2/en/coding-standards',
  );
}
