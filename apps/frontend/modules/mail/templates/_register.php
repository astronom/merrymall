<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none;" border="0">
<tr>
	<td width="100%" colspan="3" height="15"><img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" /></td>
</tr>
<tr>
<td width="15">
<img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" />
</td>
<td align="left">
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Добро пожаловать на MerryMall.</span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Ваш логин: <strong><?php echo $login ?></strong></span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Ваш пароль: <strong>  <?php echo $password ?></strong></span>
<br />
<span style="font-family:Tahoma; font-size:12px; color:#404040;">Для подтверждения регистрации вам необходимо пройти по ссылке:
<a href="<?php echo url_for('@sf_guard_confirm?guid=' . $guid, true) ?>" style="font-family:Tahoma; font-size:12px; color:#404040; text-decoration: underline;" target="_blank">Завершить регистрацию</a></span>
</td>
<td width="15">
<img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" />
</td>
</tr>
<tr>
	<td width="100%" colspan="3" height="15"><img src="http://merrymall.ru/images/c/pus.gif" width="15" height="15" /></td>
</tr>
</table>