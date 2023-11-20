<?php
// セッションを開始
session_start();

// セッション変数を全て削除
$_SESSION = array();

// 最終的に、セッションを破壊する
session_destroy();

// ログアウト後にログインページへリダイレクト
header('Location: login.php');
exit;
