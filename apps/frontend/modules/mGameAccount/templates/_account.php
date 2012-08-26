<div class="info">
	Игрок: <?php echo $sf_user->getUserFullName()?>
	<br />
	Текущий тур: <?php echo $account->getRound(); ?> / <?php echo $gameRoundsCount ?>
	<br />
	Количество покупок в туре: <?php echo $gameAccountsRoundPurchases; ?> / <?php echo $gameRoundPurchases ?>
	<br />
	Рейтинг: <?php echo $account->getRating(); ?>
	<br />
	Деньги на счете: <?php echo $account->getMoney(); ?>
	<br />
	Потрачено за игру: <?php echo $account->getMoneySpent(); ?>
	<br />
	Кредит банка: <?php echo $account->getCredit(); ?>
</div>
