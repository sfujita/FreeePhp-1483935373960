/**
 *
 */
(function() {
	"use strict";

	// The initialize function must be run each time a new page is loaded
	Office.initialize = function(reason) {
		$(document).ready(function() {
			app.initialize();

			$('#getResult').click(getResult);
		});
	};

	// Load some sample data into the worksheet and then create a chart
	function getResult() {

		// ログイン画面へ遷移する
		window.location.href = "https://secure.freee.co.jp/users/login";
	}
})();

/*
 * デバッグ情報（エラー）を出力します。
 */
function errorDebug(XMLHttpRequest, textStatus, errorThrown) {
	$("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
	$("#textStatus").html("textStatus : " + textStatus);
	$("#errorThrown").html("errorThrown : " + errorThrown.message);
}
