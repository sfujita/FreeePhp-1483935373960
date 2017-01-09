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
		$("#result").text("通信成功");

		var url = "https://freeephp.mybluemix.net/php/main.php";

		var val = "a";

		var param = {
			"request" : val
		};

		/**
		 * Ajax通信メソッド
		 */
		$.ajax({
					type : "GET",
					url : url,
					dataType: 'json',
//					dataType : "jsonp",
//					jsonp : 'jsoncallback',
//					data : param,
					/**
					 * Ajax通信が成功した場合に呼び出されるメソッド
					 */
					success : function(data) {
						$("#resultPhp").text(data + ": php通信成功");
					},

					/**
					 * Ajax通信が失敗場合に呼び出されるメソッド
					 */
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						$("#resultPhp").text("php通信失敗");
						/*
						 * 各エラーフィールドを設定
						 */
						$('#errorfield').append('<hr><p>エラーが発生しました</p>');
						// リクエスト
						$('#errorfield')
								.append(
										'<p>リクエスト</p><div id="request_url" ></div><div id="request_parameter" ></div>');
						// レスポンス
						$('#errorfield')
								.append(
										'<p>レスポンス</p><div id="response_parameter" ></div>');
						// エラー
						$('#errorfield')
								.append(
										'<p>エラー</p><div id="XMLHttpRequest" ></div><div id="textStatus" ></div><div id="errorThrown" ></div>');

						// エラー情報を出力します。
						errorDebug(XMLHttpRequest, textStatus, errorThrown);

					}
				});

		/**
		 * サンプルのコード
		 */
		// // Run a batch operation against the Excel object model
		// Excel.run(function (ctx) {
		//
		// // Create a proxy object for the active worksheet
		// var sheet = ctx.workbook.worksheets.getActiveWorksheet();
		//
		// // Queue commands to set the report title in the worksheet
		// sheet.getRange("A1").values = "Quarterly Sales Report";
		// sheet.getRange("A1").format.font.name = "Century";
		// sheet.getRange("A1").format.font.size = 26;
		//
		// // Create an array containing sample data
		// var values = [["Product", "Qtr1", "Qtr2", "Qtr3", "Qtr4"],
		// ["Frames", 5000, 7000, 6544, 4377],
		// ["Saddles", 400, 323, 276, 651],
		// ["Brake levers", 12000, 8766, 8456, 9812],
		// ["Chains", 1550, 1088, 692, 853],
		// ["Mirrors", 225, 600, 923, 544],
		// ["Spokes", 6005, 7634, 4589, 8765]];
		//
		// // Queue a command to write the sample data to the specified
		// // range
		// // in the worksheet and bold the header row
		// var range = sheet.getRange("A2:E8");
		// range.values = values;
		// sheet.getRange("A2:E2").format.font.bold = true;
		//
		// // Queue a command to add a new chart
		// var chart = sheet.charts.add("ColumnClustered", range, "auto");
		//
		// // Queue commands to set the properties and format the chart
		// chart.setPosition("G1", "L10");
		// chart.title.text = "Quarterly sales chart";
		// chart.legend.position = "right"
		// chart.legend.format.fill.setSolidColor("white");
		// chart.dataLabels.format.font.size = 15;
		// chart.dataLabels.format.font.color = "black";
		// var points = chart.series.getItemAt(0).points;
		// points.getItemAt(0).format.fill.setSolidColor("pink");
		// points.getItemAt(1).format.fill.setSolidColor('indigo');
		//
		// // Run the queued commands, and return a promise to indicate
		// // task completion
		// return ctx.sync();
		// })
		// .then(function () {
		// app.showNotification("Success");
		// console.log("Success!");
		// })
		// .catch(function (error) {
		// // Always be sure to catch any accumulated errors that bubble up
		// // from the Excel.run execution
		// app.showNotification("Error: " + error);
		// console.log("Error: " + error);
		// if (error instanceof OfficeExtension.Error) {
		// console.log("Debug info: " + JSON.stringify(error.debugInfo));
		// }
		// });
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
