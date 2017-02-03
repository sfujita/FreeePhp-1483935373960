/**
 * 事業所IDを取得するjs。
 */
//$(document).ready(function() {
//
//
//
//
//	/**
//	 * 送信ボタンクリック
//	 */
//	$('#companies').click(function() {
//
//		alert("ajax開始");
//		// POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
//		// var data = {request : $('#request').val()};
//		var data = ""; // ひとまず何も送らない
//		// 通信先php
//		var url = "https://freeephp.mybluemix.net/php/companies/companies.php";
//
//		/**
//		 * Ajax通信メソッド
//		 *
//		 * @param type :
//		 *            HTTP通信の種類
//		 * @param url :
//		 *            リクエスト送信先のURL
//		 * @param data :
//		 *            サーバに送信する値
//		 */
//		$.ajax({
//			type : "GET",
//			url : url,
//			data : data,
//			/**
//			 * Ajax通信が成功した場合に呼び出されるメソッド
//			 */
//			success : function(data, dataType) {
//				// successのブロック内は、Ajax通信が成功した場合に呼び出される
//
//				// PHPから返ってきたデータの表示
//				alert(data);
//			},
//			/**
//			 * Ajax通信が失敗した場合に呼び出されるメソッド
//			 */
//			error : function(XMLHttpRequest, textStatus, errorThrown) {
//				// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
//
//				// this;
//				// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
//
//				// エラーメッセージの表示
//				alert('Error : ' + errorThrown);
//			}
//		});
//
//		// サブミット後、ページをリロードしないようにする
//		return false;
//	});
//});



$(document).ready( function() {
    $("#companies").click(function(){
        alert('hello world! button 1');
    });

});