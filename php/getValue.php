<?php
//ajax送信でPOSTされたデータを受け取る
$post_data_1 = $_POST['post_data_1'];
$post_data_2 = $_POST['post_data_2'];

//ヘッダーの設定
header("Content-type:application/json; charset=utf8");
header("Access-Control-Allow-Origin: *");

$result = file_get_contents('https://secure.freee.co.jp/oauth/authorize?client_id=f59339c44c93cdf7598607005ddea573a200cfc23f10d5954c03e98cf027958b&redirect_uri=https%3A%2F%2Ffreeephp.mybluemix.net%2Fphp%2Fcallback.php&response_type=code');

echo json_encode($result);