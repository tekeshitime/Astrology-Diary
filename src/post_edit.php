<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['authentication'])) {
  // ログインされていない場合、login.php へリダイレクト
  header("Location: login.php");
  exit();
}

if (!empty($_GET['id'])) {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  // SQL作成
  $stmt = $pdo->prepare("SELECT * FROM post
  INNER JOIN mst_mood ON post.mood = mst_mood.mood_id
  WHERE id = :id");

  // 値をセット
  $stmt->bindValue('id', $_GET['id'], PDO::PARAM_INT);

  // SQLクエリの実行
  $stmt->execute();

  // 表示するデータを取得
  $message_data = $stmt->fetch();

  // 投稿データが取得できないときは管理ページに戻る
  if (empty($message_data)) {
    header("Location:diary.php");
    exit;
  }
  //submitを押したらデータを更新する
  if (isset($_POST['submit'])) {
    try {
      $stmt = $pdo->prepare("UPDATE post
      SET mood = ?,
          content = ?
      WHERE id = ?;");

      $stmt->execute([$_POST['mood'], $_POST['content'], $_GET['id']]);
      header("Location: diary.php");
    } catch (PDOException $e) {
      echo "error" . $e->getMessage();
      exit();
    };
  }
}
?>


<?php include './layout/header.php'; ?>

<form class="max-w-screen-md mx-auto p-4 md:p-8" method="post">
  <div class="text-5xl font-bold text-gray-400">
    <input readonly type="date" name="date" id="selectdate" value="<?php echo htmlspecialchars($message_data['date']); ?>" class='text-gray-800 dark:text-white'>
  </div>


  <div class="flex h-40 items-center">
    <p class="text-sm">感情</p>
    <div class="flex items-center">
      <input <?php if ($message_data['mood_id'] == 1) {
                echo "checked";
              }
              ?> id="mood-1" type="radio" value="1" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-1" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😱</label>
    </div>
    <div class="flex items-center">
      <input <?php if ($message_data['mood_id'] == 2) {
                echo "checked";
              }
              ?> id="mood-2" type="radio" value="2" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-2" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😥</label>
    </div>
    <div class="flex items-center">
      <input <?php if ($message_data['mood_id'] == 3) {
                echo "checked";
              }
              ?> id="mood-3" type="radio" value="3" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-3" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😀</label>
    </div>
    <div class="flex items-center">
      <input <?php if ($message_data['mood_id'] == 4) {
                echo "checked";
              }
              ?> id="mood-4" type="radio" value="4" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-4" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😋</label>
    </div>
    <div class="flex items-center">
      <input <?php if ($message_data['mood_id'] == 5) {
                echo "checked";
              }
              ?> id="mood-5" type="radio" value="5" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
      <label for="mood-5" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">🥰</label>
    </div>
  </div>

  <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">今日はどんな一日だった？</label>
  <textarea id="message" rows="4" name="content" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php if (!empty($message_data)) {
                                                                                                                                                                                                                                                                                                                                echo trim($message_data['content']);
                                                                                                                                                                                                                                                                                                                              } ?></textarea>

  <div class="text-center mt-4">
    <button type="submit" name="submit" class="text-white w-96 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">日記を更新する</button>
  </div>

</form>

<?php include './layout/footer.php'; ?>