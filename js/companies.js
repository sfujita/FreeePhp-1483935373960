Office.initialize = function (reason) {
    $(document).ready(function () {

    	// 金額設定ボタンにイベントを設定する
        $("#readDataBtn").click(function (event) {
            readData();
        });

        // <button>要素をクリックしたら発動
        $("#insert").click(function() {

          // formを送信
//          $("form").submit();
        	document.getElementById('massage').innerText = "イベント発動";

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

    });
};

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
                    document.getElementById('amount').innerText = "登録金額は" + val + "円です。";

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
 * 日付欄に/を入力する
 */
function dateConv(s) {
	  var str = s.value;
	  var n = str.length;
	  // 8桁の入力の場合、/を追加してYYYY/MM/DDの形式に変換する
	  if(n == 8) {
	      t = str.substr(0,4) +"-"+ str.substr(4,2) + "-" +str.substr(6,2);
	      s.value = t;
	  }
	}