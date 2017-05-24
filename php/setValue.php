<?php

// ファイルのパスを変数に格納
$filename = 'param.txt';

$content = "";


// 引数の金額を格納
// $param = $_POST['param'];

// ファイルの存在をチェックし、存在する場合は削除する
if (file_exists ( $filename )) {
	unlink ( $filename );

	$content = $content."ファイルを削除しました";

}

$param = "これはテスト";
// ファイルに書き込む
file_put_contents ( $filename, $param );

// ファイルを読み込み変数に格納
$content2 = file_get_contents ( $filename );

$content3 = $content.$content2;



header("Content-type: text/plain; charset=UTF-8");
echo $content3;