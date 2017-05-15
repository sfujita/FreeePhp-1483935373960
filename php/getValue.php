<?php
//ヘッダーの設定
header("Content-type:application/json; charset=utf8");
header("Access-Control-Allow-Origin: *");

// $result = file_get_contents('https://secure.freee.co.jp/oauth/authorize?client_id=f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b&redirect_uri=https%3A%2F%2Ffreeephp.mybluemix.net%2Fphp%2Fcallback.php&response_type=code');

$url = 'https://secure.freee.co.jp/oauth/authorize?client_id=f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b&redirect_uri=https%3A%2F%2Ffreeephp.mybluemix.net%2Fphp%2Fcallback.php&response_type=code';




// コネクションを開く
$conn = curl_init();

// サーバ証明書の検証は行わない。
curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, false);

// curl_execの実行結果を文字列として取得できるように設定
curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);

// 問い合わせ先のurlを指定
curl_setopt($conn, CURLOPT_URL, $url);

// パラメータを設定
// curl_setopt($conn, CURLOPT_POSTFIELDS, http_build_query($param));

// 問い合わせを行い、その結果を取得
$result = curl_exec($conn);

// コネクションを切断
curl_close($conn);









echo json_encode($result);