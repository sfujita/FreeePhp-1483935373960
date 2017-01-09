<?php
// (3) Token取得後の処理。各種APIの実行
if (! is_null ( $token ['access_token'] )) {
        $header = [
            'Authorization: Bearer ' . $token['access_token'],
        ];

	$curl = curl_init ( 'https://api.freee.co.jp/api/1/users/me?companies=true' ); // 自分の情報
	curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	$jsonResult = curl_exec ( $curl );
	$result = json_decode ( $jsonResult, true );

	var_dump ( "<br />取得した情報<br />" );
	var_dump ( $result );
}