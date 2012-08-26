<?php

class amDeleteAnonymousUsersTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('days', sfCommandArgument::OPTIONAL, 'Period from NOW of Anonymous User created', 7),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('no-confirmation', null, sfCommandOption::PARAMETER_NONE, 'Whether to force deleting anonymous users')
    ));

    $this->namespace        = 'guard';
    $this->name             = 'delete-anonymous';
    $this->briefDescription = 'Delete all anonymous users from base';
    $this->detailedDescription = <<<EOF
The [guard:delete-anonymous|INFO] delete all anonymous users from database.

	[./symfony guard:delete-anonymous|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);

    // add your code here
    $this->logSection('delete all anonymous users created '.ucfirst($arguments['days']).' days ago', null);

    $anonymousUsers = Doctrine::getTable('sfGuardUser')->createQuery('g')
    ->where('g.username LIKE ?', 'anonymous%')
    ->andWhere('g.created_at < DATE_ADD(NOW(), INTERVAL ? DAY)', ucfirst($arguments['days']))
    ->execute();

    if(!$anonymousUsers->count())
    {
      $this->log('there is no anonymous users in database');

      return 1;

    }

    foreach($anonymousUsers as $user)
    {
      $this->logSection('find user', $user->getUserName());
    }

    if (
      !$options['no-confirmation']
      &&
      !$this->askConfirmation('Delete this users. Are you shure? (Y/N)', 'QUESTION_LARGE', false)
    )
    {
      $this->logSection('guard:delete-anonymous', 'task aborted');

      return 1;
    }

    $anonymousUsers = Doctrine::getTable('sfGuardUser')->createQuery('g')
    ->delete()
    ->where('g.username LIKE ?', 'anonymous%')
    ->andWhere('g.created_at <= DATE_ADD(NOW(), INTERVAL ? DAY)', ucfirst($arguments['days']))
    ->execute();



  }
}
