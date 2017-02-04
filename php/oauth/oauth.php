<?php
define ( 'APP_ID', 'c83150addac548bc5c8cd3cc41ade1654240af3faf33e324f0ff01115149d2dd' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/oauth/getOauth.php' );
// ※注意：APP_CALLBACKの値は、freeeのアプリケーション一覧に登録されている
// コールバックURIと同じにする必要があります。

// (1) いちばん最初の処理。OAuth2の入り口。
if (empty ( $_GET )) {
	printf ( '<html><div>Freeeにログインしてください</div><br /><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">Oauth認証開始</a></html>',
			 'https://secure.freee.co.jp/oauth/authorize', // 認証用
APP_ID, urlencode ( APP_CALLBACK ) );
}