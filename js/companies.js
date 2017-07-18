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