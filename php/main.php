<?php
define('APP_ID', 'f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b');
define('CALLBACK_URL', 'https://freeephp.mybluemix.net/php/callback.php');
// 認証ページにリダイレクト
$params = array(
		'client_id' => APP_ID,
		'redirect_uri' => CALLBACK_URL,
		'response_type' => 'code', );
header("Location: " . 'https://secure.freee.co.jp/oauth/authorize/'. '?' . http_build_query($params));





//header("Content-Type: text/html; charset=UTF-8");
//echo "{\"status\":\"OK\",\"message\":\"true\"}";