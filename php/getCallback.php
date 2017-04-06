<?php
define ( 'APP_ID', '7560c9b06f7ddca9703b65c5fd5b02bc7c355ff6ca66c3e5553ad3c4d0e70e2f' );
define ( 'APP_SECRET', 'c4f731db706aadc1445c956789a5c1546ec86f61e5395332c8c1ed65003e724b' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/getCallback.php' );
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

	// var_dump ( $token );
}

// (3) Token取得後の処理。各種APIの実行
if (! is_null ( $token ['access_token'] )) {
        $header = [
            'Authorization: Bearer ' . $token['access_token'],
        ];

	// ↓↓↓↓↓↓↓
	$curl = curl_init ( 'https://api.freee.co.jp/api/1/users/me?companies=true' ); // 自分の情報（org）
	// $curl = curl_init ( 'https://api.freee.co.jp/api/1/account_items?company_id=809788' ); // 勘定科目一覧の取得
	// $curl = curl_init ( 'https://api.freee.co.jp/api/1/deals?company_id=809788' ); // 取引（収入／支出）一覧の取得

	curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	$jsonResult = curl_exec ( $curl );
	$result = json_decode ( $jsonResult, true );

	header("Content-Type:text/html; charset=UTF-8");

	var_dump ( "取得した会社名<br />" );
	var_dump ( $result ["user"] ["companies"] [0] ["display_name"] . "<br />" );
	var_dump ( "企業コード<br />" );
	var_dump ( $result ["user"] ["companies"] [0] ["id"] . "<br />" );

	// 会社コードをパラメータとしたurlを生成する
	$url = 'https://api.freee.co.jp/api/1/account_items?company_id='.$result ["user"] ["companies"] [0] ["id"];

	$curl2 = curl_init ( $url ); // 勘定科目一覧の取得
// 	$curl2 = curl_init ( 'https://api.freee.co.jp/api/1/account_items?company_id=809788' ); // 勘定科目一覧の取得
	// $curl = curl_init ( 'https://api.freee.co.jp/api/1/deals?company_id=809788' ); // 取引（収入／支出）一覧の取得

	curl_setopt ( $curl2, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $curl2, CURLOPT_RETURNTRANSFER, true );
	$jsonResult2 = curl_exec ( $curl2 );
	$result2 = json_decode ( $jsonResult2, true );

	echo ( "================== 取得した勘定科目一覧 ==================<br />" );
	echo("</ br>");
	// プルダウンで項目を表示し、valueはIDで持つ
	echo("勘定科目 : <form name=\"doFreee\" method=\"POST\" action=\"doFreee.php\"><select name=\"kamoku\">");
	foreach ($result2["account_items"] as $val) {
		echo("<option value=\"");
		echo($val["id"]);
		echo("\">");
		echo($val["name"]);
		echo("</option>");
	}
	echo("</select>");
	echo("</ br>金額 : <input type=\"text\" name=\"kingaku\">");
	echo("</ br><input type=\"text\" name=\"token\" value=".$token['access_token'].">");
	echo("<input type=\"submit\" value=\"送信\" /></form>");

}