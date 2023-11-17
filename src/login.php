<?php include './layout/header.php'; ?>

<?php
$err_msg = "";

//②サブミットボタンが押されたときの処理
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  //③データが渡ってきた場合の処理
  try {
    $db = new PDO('mysql:host=192.168.144.2; dbname=astro_diary', 'root', 'password');
    $sql = 'select count(*) from users where email=? and password=?';
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email, $password));
    $result = $stmt->fetch();
    $stmt = null;
    $db = null;

    //④ログイン認証ができたときの処理
    if ($result[0] != 0) {
      header('Location: https://www.google.com/');
      exit;

      //⑤アカウント情報が間違っていたときの処理
    } else {
      $err_msg = "アカウント情報が間違っています。";
      echo $err_msg;
    }

    //⑥データが渡って来なかったときの処理
  } catch (PDOExeption $e) {
    echo $e->getMessage();
    exit;
  }
}
?>


<div class="max-w-screen-md mx-auto p-4 md:p-8">
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
      <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">記憶</label>
    </div>
    <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ログインする</button>
  </form>
</div>

<?php include './layout/footer.php'; ?>
