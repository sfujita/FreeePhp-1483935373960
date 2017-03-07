<?php
if (isset ( $_POST ['add'] )) {
	echo "登録ボタンが押下されました";
} else if (isset ( $_POST ['remove'] )) {
	echo "削除ボタンが押下されました";
}