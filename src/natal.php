<?php
session_start();
// ログイン状態を確認
if (!isset($_SESSION['authentication'])) {
  // ログインされていない場合、login.php へリダイレクト
  header("Location: login.php");
  exit();
}
?>

<?php
require_once('config.php');
include './layout/header.php';
?>

<?php
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "SELECT * FROM userDeta
  INNER JOIN capitals
  ON userDeta.place = capitals.name";

  $stmt = $pdo->query($sql);
  foreach ($stmt as $record) {
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}
?>

<div class="max-w-screen-md mx-auto p-4 md:p-8">


  <div class="my-5 text-center">
    <p class="text-4xl font-bold">あなたのネイタルチャート</p>
  </div>
  <div class="my-10">
    <?php
    include './master_wheel/index.php'

    ?>

  </div>
</div>

<?php include './layout/footer.php'; ?>