<?php

// 引数の金額を格納
$param = $_GET['param'];
$callback = "jsonCallback";

// コールバックを設定する
if(isset($_GET['callback'])){
	$callback=$_GET['callback'];
}


// ファイルのパスを変数に格納
$fileName = 'param.txt';

// ファイルのステータスを初期化する
// "0"：新規作成
// "1"：削除&作成
$fileStatus = "0";

// ファイルの存在をチェックし、存在する場合は削除する
if (file_exists ( $fileName )) {
	unlink ( $fileName );

	// 削除&作成
	$fileStatus = "1";

}

// // ファイルに引数の金額を保持する
file_put_contents( $fileName, $param);

$jsonArray = array(
		array(
				'status'       => $fileStatus
		),
);
header('Content-Type: text/javascript; charset=utf-8');

$json = json_encode($jsonArray);


print <<<END
$callback($json);
END;