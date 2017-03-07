<?php
define ( 'APP_ID', 'f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b' );
define ( 'APP_SECRET', '7849ea17ddb74e188afda1087eae8aac9e7fa94111e89f215e816dc801cd7841' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/callback.php' );
// ※注意：APP_CALLBACKの値は、freeeのアプリケーション一覧に登録されている
// コールバックURIと同じにする必要があります。

// (1) いちばん最初の処理。OAuth2の入り口。
if (empty ( $_GET )) {
	printf ( '<html><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">sammple認証開始</a></html>',
			 'https://secure.freee.co.jp/oauth/authorize', // 認証用
APP_ID, urlencode ( APP_CALLBACK ) );
}

