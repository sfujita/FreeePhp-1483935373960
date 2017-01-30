<?php
define ( 'APP_ID', 'c51200f7d63b84569dcb4b62b36d8e78b97a435fa2abd813398da29757e5efc6' );
define ( 'APP_SECRET', 'c4f731db706aadc1445c956789a5c1546ec86f61e5395332c8c1ed65003e724b' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/testCallback.php' );
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

	// POST処理
	// ここに渡すパラメータを設定する
	var_dump ( "POST処理" );
	$data = '{
		"company_id" : 809788,
		"issue_date" : "2017-01-19",
		"due_date" : "2017-02-28",
		"type" : "income",
		"details" : [
		{
		"account_item_id" : 127717210,
		"tax_code" : 108,
		"item_id" : 127358720,
		"amount" : 88888,
		"description" : "株式会社ジョインシップのコミット確認"
		}
		],
		"payments" : [
		{
		"date" : "2017-01-28",
		"from_walletable_type" : "credit_card",
		"from_walletable_id" : 150980,
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

	$header = [
			'Authorization: Bearer ' . $token['access_token'],
	];

	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token ['access_token']
	) );
	// curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );

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