<?php

// jsonのコールバックを設定する
$callback = "jsonCallback";
if(isset($_GET['callback'])){
	$callback=$_GET['callback'];
}


// ファイルのパスを変数に格納
$filename = 'param.txt';

// 返却用ステータスを初期化する
$status = "0";


// 引数の金額を格納
$param = $_GET['param'];

// ファイルの存在をチェックし、存在する場合は削除する
if (file_exists ( $filename )) {
	unlink ( $filename );

	// ステータスを"1"：削除に変更する
	$status = "1";

}

// 引数の金額をテキストファイルに書き込む
$text = filter_input(INPUT_GET, $param);




$jsonArray = array(
		array(
				'status'       => $status
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
$json = json_encode($jsonArray);

print <<<END
$callback($json);
END;