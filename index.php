<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<script src="../js/jquery-1.9.1.min.js"></script>
<script src="../js/main.js" type="text/javascript"></script>
<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js"
	type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="./css/main.css" />
<script>
	// 画面読み込み時に実行される(word)
	Office.initialize = function(reason) {
		$(document).ready(
				function() {
					Office.context.document.addHandlerAsync(
							Office.EventType.DocumentSelectionChanged,
							document_SelectionChanged);
					$('#search').click(searchDataBase);
				});
	}
</script>
</head>
<body>
	<button id="search" disabled="disabled">開始</button>
	<br />
</body>

</html>