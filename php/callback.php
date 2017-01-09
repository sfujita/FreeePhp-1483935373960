<?php
// アプリ設定
define('APP_ID', 'f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b');
define('SECRET', '7849ea17ddb74e188afda1087eae8aac9e7fa94111e89f215e816dc801cd7841');
define('CALLBACK_URL', 'https://freeephp.mybluemix.net/php/callback.php');

// アクセストークンの取得
$params = http_build_query(
array(
'grant_type' => 'authorization_code',
'client_id' => APP_ID,
'client_secret' => SECRET,
'code' => $_GET['code'], //認証用URLで取得したコード
'redirect_uri' => CALLBACK_URL, ));
$headers = array( "Content-type: application/x-www-form-urlencoded" );

//POST送信
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.freee.co.jp/oauth/token');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HEADER, true);

$response = curl_exec($curl);
$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
$result = json_decode($body, true);

$access_token = $result['access_token'];
print_r($access_token); //テスト用に表示