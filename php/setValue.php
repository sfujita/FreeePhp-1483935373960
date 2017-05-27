<?php

// ファイルのパスを変数に格納
// $filename = 'param.txt';

// $content = "";


// // 引数の金額を格納
// // $param = $_POST['param'];

// // ファイルの存在をチェックし、存在する場合は削除する
// if (file_exists ( $filename )) {
// 	unlink ( $filename );

// 	$content = $content."ファイルを削除しました";

// }

// $text = filter_input(INPUT_GET, 'text');
// $callback = filter_input(INPUT_GET, 'callback');
// $callback = htmlspecialchars(strip_tags($callback));

// $param = ['text' => $text . ", World!"];

// header('Content-type: text/javascript; charset=utf-8');
// printf("{$callback}(%s)", json_encode( $param ));

$callback = "jsonCallback";
if(isset($_GET['callback'])){
	$callback=$_GET['callback'];
}



$jsonArray = array(
		array(
				'title'       => 'テストデータ１タイトル',
				'description' => 'テストデータ１概要',
				'url' => 'http://www.google.com'
		),
		array(
				'title'       => 'テストデータ２タイトル',
				'description' => 'テストデータ２概要',
				'url' => 'http://www.google.com'
		),
		array(
				'title'       => 'テストデータ３タイトル',
				'description' => 'テストデータ３概要',
				'url' => 'http://www.google.com'
		),
		array(
				'title'       => 'テストデータ４タイトル',
				'description' => 'テストデータ４概要',
				'url' => 'http://www.google.com'
		),
		array(
				'title'       => 'テストデータ５タイトル',
				'description' => 'テストデータ５概要',
				'url' => 'http://www.google.com'
		),
);
header('Content-Type: text/javascript; charset=utf-8');
// echo sprintf("callback(%s)",json_encode($jsonArray));

$json = json_encode($jsonArray);


print <<<END
$callback($json);
END;

