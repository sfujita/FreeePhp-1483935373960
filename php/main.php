<?php
$html = "XXX";

header ( 'Content-type: application/json' ); // 指定されたデータタイプに応じたヘッダーを出力する
echo json_encode ( $html );