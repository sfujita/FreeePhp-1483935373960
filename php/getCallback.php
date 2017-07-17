<?php
// 定数：freeeのアプリケーション一覧に登録している値
define ( 'APP_ID', '7560c9b06f7ddca9703b65c5fd5b02bc7c355ff6ca66c3e5553ad3c4d0e70e2f' );
define ( 'APP_SECRET', 'c4f731db706aadc1445c956789a5c1546ec86f61e5395332c8c1ed65003e724b' );
define ( 'APP_CALLBACK', 'https://freeephp.mybluemix.net/php/getCallback.php' );

/**
 * グローバル変数
 */
// ログイン情報
$result = null;
// 勘定科目
$kanjyoKamoku = null;
// 税区分
$zeiKubun = null;

// ログイン後にトークンを取得する
if (! empty ( $_GET ['code'] )) {
        $content = [
            "code"          => $_GET['code'],
            "grant_type"    => "authorization_code",
            "client_id"     => APP_ID,
            "client_secret" => APP_SECRET,
            "redirect_uri"  => APP_CALLBACK,
        ];

	$curl = curl_init ( 'https://api.freee.co.jp/oauth/token.json' ); // 認証済みToken取得用
	curl_setopt ( $curl, CURLOPT_POST, TRUE );
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $content ) );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	$jsonToken = curl_exec ( $curl );
	$token = json_decode ( $jsonToken, true );
}

// 取得したトークンからログイン情報を元に、登録用の各情報を取得する
if (! is_null ( $token ['access_token'] )) {
        $header = [
            'Authorization: Bearer ' . $token['access_token'],
        ];

	// ログイン情報を取得する
	$curl = curl_init ( 'https://api.freee.co.jp/api/1/users/me?companies=true' );

	curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	$jsonResult = curl_exec ( $curl );
	// $result = json_decode ( $jsonResult, true );
	// グローバル変数に格納
	$GLOBALS ['result'] = json_decode ( $jsonResult, true );

	// header ( "Content-Type:text/html; charset=UTF-8" );

	// var_dump ( "取得した会社名<br />" );
	// var_dump ( $result ["user"] ["companies"] [0] ["display_name"] . "<br />" );
	// var_dump ( "企業コード<br />" );
	// var_dump ( $result ["user"] ["companies"] [0] ["id"] . "<br />" );

	/******************　勘定科目取得処理開始　******************/

	// 企業コードをパラメータとした勘定科目取得用urlを生成する
	$url = 'https://api.freee.co.jp/api/1/account_items?company_id=' . $GLOBALS ['result']["user"] ["companies"] [0] ["id"];

	$kamokuCurl = curl_init ( $url ); // 勘定科目一覧の取得
	                             // $curl2 = curl_init ( 'https://api.freee.co.jp/api/1/account_items?company_id=809788' ); // 勘定科目一覧の取得
	                             // $curl = curl_init ( 'https://api.freee.co.jp/api/1/deals?company_id=809788' ); // 取引（収入／支出）一覧の取得

	curl_setopt ( $kamokuCurl, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $kamokuCurl, CURLOPT_RETURNTRANSFER, true );
	$kamokuJsonResult = curl_exec ( $kamokuCurl );
	$GLOBALS ['kanjyoKamoku'] = json_decode ( $kamokuJsonResult, true );


	// ※※※※※※※※※※※　勘定科目取得処理終了　※※※※※※※※※※※

	// ※※※※※※※※※※※　税区分コード取得処理開始　※※※※※※※※※※※

	// 会社コードをパラメータとしたurlを生成する
	$urlZei = 'https://api.freee.co.jp/api/1/taxes/codes?company_id=' . $GLOBALS ['result']["user"] ["companies"] [0] ["id"];

	$curlZei = curl_init ( $urlZei ); // 税区分の取得

	curl_setopt ( $curlZei, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $curlZei, CURLOPT_RETURNTRANSFER, true );
	$zeiJsonResult = curl_exec ( $curlZei );
	$GLOBALS ['zeiKubun'] = json_decode ( $zeiJsonResult, true );

	// ※※※※※※※※※※※　税区分コード取得処理終了　※※※※※※※※※※※

	$today = date ( "Y-m-d" );

	// var_dump ( "取得した会社名<br />" );
	// var_dump ( $result ["user"] ["companies"] [0] ["display_name"] . "<br />" );
	// var_dump ( "企業コード<br />" );
	// var_dump ( $result ["user"] ["companies"] [0] ["id"] . "<br />" );

	// echo ("================== 取得した会社名 ==================<br />");
	// echo ( $result ["user"] ["companies"] [0] ["display_name"] . "<br />" );
	// echo ( "企業コード<br />" );
	// echo ( $result ["user"] ["companies"] [0] ["id"] . "<br />" );

	// echo ("================== 取得した勘定科目一覧 ==================<br />");
	// echo ("</ br>");
	// // プルダウンで項目を表示し、valueはIDで持つ
	// echo ("勘定科目 : <form name=\"doFreee\" method=\"POST\" action=\"doFreee.php\"><select name=\"kamoku\">");
	// foreach ( $result2 ["account_items"] as $val ) {
	// echo ("<option value=\"");
	// echo ($val ["id"]);
	// echo ("\">");
	// echo ($val ["name"]." (".$val ["id"].")");
	// echo ("</option>");
	// }
	// echo ("</select>");

	// echo ("<br />");
	// echo ("税区分コード");
	// echo ("<select name=\"taxCode\">");
	// foreach ( $resultZei ["taxes"] as $valZei ) {
	// echo ("<option value=\"");
	// echo ($valZei ["code"]);
	// echo ("\">");
	// echo ($valZei ["name_ja"]);
	// echo ("</option>");
	// }
	// echo ("</select>");

	// echo ("<br />");
	// echo ("取引タイプ");
	// echo ("<select name=\"type\">");
	// echo ("<option value=\"income \">収入</option>");
	// echo ("<option value=\"expense \">支出</option>");
	// echo ("</select>");

	// echo("<br />発生日 (yyyy-mm-dd) : <input type=\"text\" value=$today name=\"issueDate\">");
	// echo("<br />支払期日 (yyyy-mm-dd)※省略可 : <input type=\"text\" name=\"dueDate\">");

	// echo ("<br />金額 : <input type=\"text\" name=\"kingaku\">");
	// echo ("<br /><input type=\"hidden\" name=\"token\" value=" . $token ['access_token'] . ">");
	// echo ("<input type=\"submit\" value=\"送信\" /></form>");
}

$html = <<<EOT
<html>
<head><title>確認画面</title>
<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js" type="text/javascript"></script>
</head>
<body>
    <h2>登録会社名</h2>
    <p>{$result["user"] ["companies"] [0] ["display_name"]}</p>
  　　　<h2>登録企業コード</h2>
    <p>{$result["user"] ["companies"] [0] ["id"]}</p>
	<h2>勘定科目</h2><form name="doFreee" method="POST" action="doFreee.php"><select name="kamoku">
	<?php
		$today = date ( "Y-m-d" );
		echo $today;
		echo $today;
		echo $today;
	?>
	</select>
	{$kanjyoKamoku}
	<h2>税区分</h2>
	{$zeiKubun}
</body>
</html>
EOT;

header ( "Content-Type:text/html; charset=UTF-8" );

echo ($html);