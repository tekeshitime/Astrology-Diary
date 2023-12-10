<?php
session_start();
require_once('config.php');

if (isset($_POST['login'])) {
  //メールアドレスのバリデーション
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message = '入力された値が不正です。';
  }
  //DB内でPOSTされたメールアドレスを検索
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from userdeta where email = ?');
    $stmt->execute([$_POST['email']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
  //emailがDB内に存在しているか確認
  if (!isset($row['email'])) {
    $message = 'メールアドレス又はパスワードが間違っています。';
  }
  //パスワード確認後sessionにidを渡す
  if (password_verify($_POST['password'], $row['password'])) {
    session_regenerate_id(true); //session_idを新しく生成し、置き換える
    $_SESSION['authentication'] = true;
    $_SESSION['id'] = $row['id'];
    header("Location: profile.php");
    exit;
  } else {
    $message = 'メールアドレス又はパスワードが間違っています。';
  }
}
?>
<?php include './layout/header.php'; ?>
<div class="max-w-screen-sm mx-auto p-4 md:p-8">
  <?php if (isset($_SESSION['message'])) : ?>
    <p class="text-green-600"><?php echo htmlspecialchars($_SESSION['message']) ?></p>
    <br><br>
  <?php endif ?>
  <?php if (isset($message)) : ?>
    <p class="text-red-600"><?php echo htmlspecialchars($message) ?></p>
    <br><br>
  <?php endif ?>

  <form action="" method="POST">
    <div class="mb-6">
      <label for="signin-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
      <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">パスワード</label>
      <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>
    <div class="flex items-start mb-6">
      <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
      </div>
    </div>
    <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ログインする</button>
  </form>
  <div>
    <span class="mt-4">アカウントをお持ちでない方</span><a href="register.php" class="ml-2">新規登録</a>
  </div>
</div>



<?php include './layout/footer.php'; ?>