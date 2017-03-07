<?php
define ( 'APP_ID', 'f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b' );
define ( 'APP_SECRET', '7849ea17ddb74e188afda1087eae8aac9e7fa94111e89f215e816dc801cd7841' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/callback.php' );

if (! empty ( $_GET ['code'] )) {

	// 変数に取得したauthorization codeを格納する
	$code = $_GET ['code'];

echo <<< EOM
<form action="getAccessToken.php" method="post">
	$code
    <input type="submit" name="add" value="登録" />
    <input type="submit" name="remove" value="削除" />
</form>
EOM;
?>
