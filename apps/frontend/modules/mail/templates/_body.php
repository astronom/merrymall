<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="710" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:#cccccc 1px solid;">
<tr><td border="0" style="border:none;"><?php include_partial('mail/header', array('header_mesage' => $header_mesage))?></td></tr>
<tr><td border="0" style="border:none;"><?php include_partial("mail/$partial", $vars) ?></td></tr>
<tr><td border="0" style="border:none; border-top:#83b4d5 5px solid;"><?php include_component('mail', 'footer')?></td></tr>
</table>
</body>
</html>
