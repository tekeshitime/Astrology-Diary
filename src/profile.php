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
  $sql = "SELECT * FROM userDeta";

  $stmt = $pdo->query($sql);
  foreach ($stmt as $record) {
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}
?>

<div class="max-w-screen-md mx-auto p-4 md:p-8">
  <div class="mb-4">
    <div class="">
      <p>こんにちは、<b><?php echo $record["username"]; ?></b>さん</p>
    </div>
    <div class="">
      <p>あなたのメールアドレスは<b><?php echo $record["email"]; ?></b>です</p>
    </div>
    <div class="">
      <p>あなたの生年月日は<b>
          <?php echo $record["birth_y"] . "年" . $record["birth_m"] . "月" . $record["birth_d"] . "日" ?>
        </b>です</p>
    </div>
    <div class="">
      <p>生まれた時間は<b><?php echo $record["birth_hour"] . '時' . $record["birth_m"] . "分" ?></b>です</p>
    </div>
    <div class="">
      <p>生まれた場所は<b><?php echo $record["place"]; ?></b>です</p>
    </div>
  </div>

  <div class="">
    <div class="inline-flex rounded-md">
      <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-gray-300 border border-gray-200 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">プロフィールを修正する</a>
    </div>
    <a href="#" class="text-blue-700">ログアウトする</a>

  </div>


</div>

<?php include './layout/footer.php'; ?>