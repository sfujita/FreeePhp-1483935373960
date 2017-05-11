<?php
//ajax送信でPOSTされたデータを受け取る
$post_data_1 = $_POST['post_data_1'];
$post_data_2 = $_POST['post_data_2'];

//受け取ったデータを配列に格納
$return_array = array($post_data_1, $post_data_2);

//ヘッダーの設定
header("Content-type:application/json; charset=utf8");
header("Access-Control-Allow-Origin: *");

//「$return_array」をjson_encodeして出力
echo json_encode($return_array);