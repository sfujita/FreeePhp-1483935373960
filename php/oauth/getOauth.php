<?php
define ( 'APP_ID', 'c83150addac548bc5c8cd3cc41ade1654240af3faf33e324f0ff01115149d2dd' );
define ( 'APP_SECRET', '469f4594136f8f2e0eccfbf890722af55616c9d355b10545d53e276abe2db18e' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/oauth/getOauth.php' );
// ※注意：APP_CALLBACKの値は、freeeのアプリケーション一覧に登録されている
// コールバックURIと同じにする必要があります。

// (1) いちばん最初の処理。OAuth2の入り口。
// if (empty ( $_GET )) {
// printf ( '<html><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">認証開始</a></html>', 'https://secure.freee.co.jp/oauth/authorize', // 認証用
// APP_ID, urlencode ( APP_CALLBACK ) );
// }

// (2) freeeで「許可する」が押されたあとに実行する処理
if (! empty ( $_GET ['code'] )) {
        $content = [
            "code"          => $_GET['code'],
            "grant_type"    => "authorization_code",
            "client_id"     => APP_ID,
            "client_secret" => APP_SECRET,
            "redirect_uri"  => APP_CALLBACK,
        ];

	$curl = curl_init ( 'https://api.freee.co.jp/oauth/token.json' ); // 認証済みToken取得用
	curl_setopt ( $curl, CURLOPT_POST, TRUE );
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $content ) );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	$jsonToken = curl_exec ( $curl );
	$token = json_decode ( $jsonToken, true );

	print<<<EOF
	<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
		<title>TOKEN取得</title>
// 		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
// 		<script type="text/javascript" src="js/companies.js"></script>
		</head>
		<body>
// 			<div>TOKEN取得完了</div>
// 			<br />
// 			<div>TOKENは</div>
// 			<br />
// 			<div>$token</div>

		</body>
		</html>

	EOF;

	var_dump($token);

}

// // (3) Token取得後の処理。各種APIの実行
// if (! is_null ( $token ['access_token'] )) {
//         $header = [
//             'Authorization: Bearer ' . $token['access_token'],
//         ];

// 	// ↓↓↓↓↓↓↓
// //  	$curl = curl_init ( 'https://api.freee.co.jp/api/1/users/me?companies=true' ); // 自分の情報（org）
// 	$curl = curl_init ( 'https://api.freee.co.jp/api/1/account_items?company_id=809788' ); // 勘定科目一覧の取得
// // 	$curl = curl_init ( 'https://api.freee.co.jp/api/1/deals?company_id=809788' ); // 取引（収入／支出）一覧の取得

// 	curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
// 	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
// 	$jsonResult = curl_exec ( $curl );
// 	$result = json_decode ( $jsonResult, true );

// 	var_dump ( "取得した情報" );
// 	var_dump ( $result );
// 	// ↑↑↑↑↑↑↑↑




// 	var_dump ( "取得した情報" );
// 	var_dump ( $result );
// }