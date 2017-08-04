Office.initialize = function (reason) {
    $(document).ready(function () {

    	// 金額設定ボタンにイベントを設定する
        $("#readDataBtn").click(function (event) {
            readData();
        });

        // <button>要素をクリックしたら発動
        $("#insert").click(function() {

          // formを送信
        	$("form").submit();

        });

        // 発生日の入力値を編集する
        $("#issueDate").blur(function(){
        	var date =　dateConv($("#issueDate").val());

        	$("#issueDate").val(date);
        });

        // 支払期日の入力値を編集する
        $("#dueDate").blur(function(){
        	var date =　dateConv($("#dueDate").val());

        	$("#dueDate").val(date);
        });

        // 登録ボタンを非活性化
        $("#insert").prop("disabled", true);

        setToday();

    });
};

/**
 * 発生日欄にデフォルト値で現在の日付を設定する
 */
function setToday() {

	var today = new Date();

	// 西暦を取得する
	var year = today.getFullYear();
	// 月を取得する
	var month = today.getMonth() + 1;
	// 月が一桁だった場合、頭に0を付ける
	if (1 == month.length) {
		month = "0" + month;
	}
	// 日を取得する
	var day = today.getDate();
	// 日が一桁だった場合、頭に0を付ける
	if (1 == day.length) {
		day = "0" + day;
	}

	$("#issueDate").val(year + "-" + month + "-" + day);
}

/**
 * 金額設定ボタン押下時イベント
 */
function readData() {
    Office.context.document.getSelectedDataAsync("matrix", function (asyncResult) {
        if (asyncResult.status === "failed") {
            writeToPage('Error: ' + asyncResult.error.message);
        }
        else {

            var val = asyncResult.value;

            if (val != "") {

                if (isNaN(val)) {
                    document.getElementById('massage').innerText = "半角数値で入力して下さい";

                    // 登録ボタンを非活性化
                    $("#insert").prop("disabled", true);
                } else {
//                    document.getElementById('amount').innerText = "登録金額は" + val + "円です。";

                    $("kingaku").val(val);

                    // 登録ボタンを活性化
                    $("#insert").prop("disabled", false);
                }


            } else {
                document.getElementById('massage').innerText = "入力されていません。";

                // 登録ボタンを非活性化
                $("#insert").prop("disabled", true);
            }


        }
    });
}

/**
 * 日付欄に-を入力する
 */
function dateConv(date) {

	// 10桁の場合、何もしない
	if (date.length == 10) {
		return date;
	}

	// 8桁の入力の場合、/を追加してYYYY-MM-DDの形式に変換する
	if　(date.length == 8) {
		var t = date.substr(0,4) +"-"+ date.substr(4,2) + "-" +date.substr(6,2);
		return t;
	}

	return null;
}