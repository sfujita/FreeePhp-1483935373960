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

$text = filter_input(INPUT_GET, 'text');
$callback = filter_input(INPUT_GET, 'callback');
$callback = htmlspecialchars(strip_tags($callback));

$param = ['text' => $text . ", World!"];

header('Content-type: text/javascript; charset=utf-8');
printf("{$callback}(%s)", json_encode( $param ));