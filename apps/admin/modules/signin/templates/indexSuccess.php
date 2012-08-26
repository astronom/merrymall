<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
<table id="centerform" cellspacing="0" cellpadding="0">
	<tr>
		<td class="cr4">
		<h1>Авторизация</h1>

		<table class="cr6" cellspacing="0" cellpadding="0" align="center">
		<?php echo $form ?>
			<tr>
				<td class="ra2">&nbsp;</td>
				<td class="ra6"><input id="submitButton" type="image"
					src="/images/buttons/enter.gif" /></td>
			</tr>
			<tr>
				<td class="ra2">&nbsp;</td>
				<td class="ra5">
				<table width="100%">
					<tr>
						<td><a href="<?php echo url_for('@sf_guard_restore_password') ?>">Забыли
						пароль?</a></td>
						<td><a href="<?php echo url_for('@sf_guard_register') ?>">Регистрация</a></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
