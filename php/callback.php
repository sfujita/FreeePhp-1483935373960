<?php
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

	var_dump ( $token );
}

// (3) Token取得後の処理。各種APIの実行
if (! is_null ( $token ['access_token'] )) {
        $header = [
            'Authorization: Bearer ' . $token['access_token'],
        ];

	// ↓↓↓↓↓↓↓
	// $curl = curl_init ( 'https://api.freee.co.jp/api/1/users/me?companies=true' ); // 自分の情報（org）
	// $curl = curl_init ( 'https://api.freee.co.jp/api/1/account_items?company_id=809788' ); // 勘定科目一覧の取得

	// curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
	// curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	// $jsonResult = curl_exec ( $curl );
	// $result = json_decode ( $jsonResult, true );

	// var_dump ( "取得した情報" );
	// var_dump ( $result );
	// ↑↑↑↑↑↑↑↑

	// POST処理
	var_dump ( "POST処理" );
	// $data = "{
	// \"company_id\" : 809788,
	// \"issue_date\" : \"2013-01-01\",
	// \"due_date\" : \"2013-02-28\",
	// \"type\" : \"expense\",
	// \"partner_id\" : 201,
	// \"ref_number\" : \"123-456\",
	// \"details\" : [
	// {
	// \"account_item_id\" : 803,
	// \"tax_code\" : 6,
	// \"item_id\" : 501,
	// \"section_id\" : 1,
	// \"tag_ids\" : [1, 2, 3],
	// \"amount\" : 6666,
	// \"description\" : \"備考\"
	// }
	// ],
	// \"payments\" : [
	// {
	// \"date\" : \"2013-01-28\",
	// \"from_walletable_type\" : \"bank_account\",
	// \"from_walletable_id\" : 103,
	// \"amount\" : 6666
	// }
	// ]
	// }";

	$data = '{
  "company_id" : 809788,
  "issue_date" : "2017-01-21",
  "due_date" : "2017-02-28",
  "type" : "expense",
  "details" : [
    {
      "account_item_id" : 803,
      "tax_code" : 6,
      "item_id" : 501,
      "amount" : 99999,
      "description" : "備考"
    }
  ],
  "payments" : [
    {
      "date" : "2013-01-28",
      "from_walletable_type" : "bank_account",
      "from_walletable_id" : 103,
      "amount" : 66666
    }
  ]
}';

	$url = 'https://api.freee.co.jp/api/1/deals';

	$options = array (
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_AUTOREFERER => true
	);
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json'
	) );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt ( $ch, CURLOPT_VERBOSE, true );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt_array ( $ch, $options );
	$result = curl_exec ( $ch );
	curl_close ( $ch );

	var_dump ( "取得した情報" );
	var_dump ( $result );
}