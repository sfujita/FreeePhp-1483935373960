<?php
// アプリの設定内容
define ( 'APP_ID', '9bb2678db02fb1f1102815096d8b7213a322eac1cb9170d1f9fb4d7eeeb9ec98' );
define ( 'APP_SECRET', '6db8b688d72d7a4bb26367c4fcad9c82ddf549525a108044f071bb0c4e46f0f9' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/companies/companiesCallback.php' );


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