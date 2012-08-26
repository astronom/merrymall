Добро пожаловать на MerryMall.
Ваш логин: <?php echo $login ?>.
Ваш пароль: <?php echo $password ?>.
Для подтверждения регистрации вам необходимо пройти по ссылке:
<?php echo url_for('@sf_guard_confirm?guid=' . $guid, true) ?>