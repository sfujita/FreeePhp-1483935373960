<?php
header("Content-Type:text/html; charset=UTF-8");
echo "プルダウンは : ".$_POST['kamoku']."金額は ".$_POST['kingaku']."tokenは ".$_POST['token'];

$token = $_POST['token']; // トークン
$kingaku = $_POST['kingaku']; // 取引金額
$kamoku = $_POST['kamoku']; // 勘定科目
$type = $_POST['type']; // 取引タイプ

// POST処理
var_dump ( "POST処理" );
$data = "{
		\"company_id\" : 809788,
		\"issue_date\" : \"2017-01-19\",
		\"due_date\" : \"2017-02-28\",
		\"type\" : $type,
		\"details\" : [
		{
		\"account_item_id\" : $kamoku,
		\"tax_code\" : 108,
		\"item_id\" : 127358720,
		\"amount\" : $kingaku,
		\"description\" : \"株式会社ジョインシップ\"
		}
		],
		\"payments\" : [
		{
		\"date\" : \"2017-01-28\",
		\"from_walletable_type\" : \"credit_card\",
		\"from_walletable_id\" : 150980,
		\"amount\" : $kingaku
		}
	 ]
	}";


echo "<br />";
var_dump($data);
echo "<br />";

// $data = '{
// 		"company_id" : 809788,
// 		"issue_date" : "2017-01-19",
// 		"due_date" : "2017-02-28",
// 		"type" : "income",
// 		"details" : [
// 		{
// 		"account_item_id" : 127717210,
// 		"tax_code" : 108,
// 		"item_id" : 127358720,
// 		"amount" : 88888,
// 		"description" : "株式会社ジョインシップ"
// 		}
// 		],
// 		"payments" : [
// 		{
// 		"date" : "2017-01-28",
// 		"from_walletable_type" : "credit_card",
// 		"from_walletable_id" : 150980,
// 		"amount" : 66666
// 		}
// 	 ]
// 	}';

$url = 'https://api.freee.co.jp/api/1/deals';

$options = array (
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_AUTOREFERER => true
);
$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );

$header = [
		'Authorization: Bearer ' . $token,
];

// $header = [
// 		'Authorization: Bearer ' . $token['access_token'],
// ];


curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
		'Content-Type: application/json',
		'Authorization: Bearer ' . $token
) );
// curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );

curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
curl_setopt ( $ch, CURLOPT_VERBOSE, true );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
curl_setopt ( $ch, CURLOPT_POST, true );
curl_setopt_array ( $ch, $options );
$result = curl_exec ( $ch );
curl_close ( $ch );

var_dump ( "取得した情報" );
var_dump ( $result );