<?php
ini_set("display_errors", On);
error_reporting(E_ALL);
define ( 'APP_ID', 'f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b' );
define ( 'APP_SECRET', '7849ea17ddb74e188afda1087eae8aac9e7fa94111e89f215e816dc801cd7841' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/callback.php' );
// ※注意：APP_CALLBACKの値は、freeeのアプリケーション一覧に登録されている
// コールバックURIと同じにする必要があります。

// (1) いちばん最初の処理。OAuth2の入り口。
// if (empty ( $_GET )) {
// printf ( '<html><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">認証開始</a></html>', 'https://secure.freee.co.jp/oauth/authorize', // 認証用
// APP_ID, urlencode ( APP_CALLBACK ) );
// }

// (2) freeeで「許可する」が押されたあとに実行する処理
if (! empty ( $_GET ['code'] )) {

	$code = $_GET ['code'];
	$clientId = $_GET['client_id'];
//         $content = [
//             "code"          => $_GET['code'],
//             "grant_type"    => "authorization_code",
//             "client_id"     => APP_ID,
//             "client_secret" => APP_SECRET,
//             "redirect_uri"  => APP_CALLBACK,
//         ];

// 	$curl = curl_init ( 'https://api.freee.co.jp/oauth/token.json' ); // 認証済みToken取得用
// 	curl_setopt ( $curl, CURLOPT_POST, TRUE );
// 	curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $content ) );
// 	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
// 	$jsonToken = curl_exec ( $curl );
// 	$token = json_decode ( $jsonToken, true );

// 	var_dump ( $token );
}

echo <<< EOM
<form action="input.php" method="post">
	$code<br />
	$clientId<br />
    <input type="submit" name="add" value="登録" />
    <input type="submit" name="remove" value="削除" />
</form>
EOM;
?>
