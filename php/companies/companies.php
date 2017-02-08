// <?php
// // アプリの設定内容
// define ( 'APP_ID', '9bb2678db02fb1f1102815096d8b7213a322eac1cb9170d1f9fb4d7eeeb9ec98' );
// // define ( 'APP_SECRET', '6db8b688d72d7a4bb26367c4fcad9c82ddf549525a108044f071bb0c4e46f0f9' );
// define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/companies/companiesCallback.php' );

// // 認証ページにリダイレクト
// $params = array(
// 		'client_id' => APP_ID,
// 		'redirect_uri' => CALLBACK_URL,
// 		'response_type' => 'code', );
// header("Location: " . 'https://secure.freee.co.jp/oauth/authorize/'. '?' . http_build_query($params));