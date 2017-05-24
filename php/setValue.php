<?php

// ファイルのパスを変数に格納
$filename = 'param.txt';
// 引数の金額を格納
// $param = $_POST['param'];

// ファイルの存在をチェックし、存在する場合は削除する
if (file_exists ( $filename )) {
	unlink ( $filename );
}

$param = "これはテスト";
// ファイルに書き込む
file_put_contents ( $filename, $param );

// ファイルを読み込み変数に格納
$content = file_get_contents ( $filename );

header ( 'Content-Type: application/json; charset=utf-8' );
echo json_encode ( $content );