<?php
define ( 'APP_ID', '7560c9b06f7ddca9703b65c5fd5b02bc7c355ff6ca66c3e5553ad3c4d0e70e2f' );
define ( 'APP_SECRET', 'c4f731db706aadc1445c956789a5c1546ec86f61e5395332c8c1ed65003e724b' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/getCallback.php' );

// ヘッダーを指定する
header("Content-Type:text/html; charset=UTF-8");
// (1) いちばん最初の処理。OAuth2の入り口。
if (empty ( $_GET )) {
	printf ( '<html><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">認証開始</a></html>',
			 'https://secure.freee.co.jp/oauth/authorize', // 認証用
APP_ID, urlencode ( APP_CALLBACK ) );
}