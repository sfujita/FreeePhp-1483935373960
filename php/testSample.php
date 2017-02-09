<?php
define ( 'APP_ID', 'c51200f7d63b84569dcb4b62b36d8e78b97a435fa2abd813398da29757e5efc6' );
define ( 'APP_SECRET', '34c60db8c3e6f16e1255599cbd00cba875e4edfd8461d6d9b5131b4f1c3829f3' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/testCallback.php' );

// (1) いちばん最初の処理。OAuth2の入り口。
if (empty ( $_GET )) {
	printf ( '<html><a href="%s?client_id=%s&redirect_uri=%s&response_type=code">テスト用認証開始3</a></html>',
			 'https://secure.freee.co.jp/oauth/authorize', // 認証用
APP_ID, urlencode ( APP_CALLBACK ) );
}