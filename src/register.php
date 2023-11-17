<?php
require_once('config.php');
//データベースへ接続、テーブルがない場合は作成
if (isset($_POST['register'])) {
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("create table if not exists userDeta(
        id int not null auto_increment primary key,
        email varchar(255),
        password varchar(255),
        created timestamp not null default current_timestamp
      )");
  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
  //メールアドレスのバリデーション
  if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo '入力された値が不正です。';
    return false;
  }
  //正規表現でパスワードをバリデーション
  if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  } else {
    echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
    return false;
  }
  //データベース内のメールアドレスを取得
  $stmt = $pdo->prepare("select email from userDeta where email = ?");
  $stmt->execute([$email]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  //データベース内のメールアドレスと重複していない場合、登録する。
  if (!isset($row['email'])) {
    $stmt = $pdo->prepare("insert into userDeta(email, password) value(?, ?)");
    $stmt->execute([$email, $password]);
?>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="shinjin.css">

    <body id="log_body">
      <main class="main_log">
        <p>登録完了</p>
        <h1 style="text-align:center;margin-top: 0em;margin-bottom: 1em;" class="h1_log">ログインしてください</h1>
        <form action="login.php" method="post" class="form_log">
          <!--<label for="email" class="label">メールアドレス</label><br>-->
          <input type="email" name="email" class="textbox un" placeholder="メールアドレス"><br>
          <!--<label for="password" class="label">パスワード</label><br>-->
          <input type="password" name="password" class="textbox pass" placeholder="パスワード"><br>
          <button type="submit" class="log_button">ログインする</button>
        </form>
        <p class="text-center">戻るボタンや更新ボタンを押さないでください</p>
    </body>
  <?php
  } else {
  ?>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <body id="log_body">
      <main class="main_log">
        <p>既に登録されたメールアドレスです</p>
        <h1 style="text-align:center;margin-top: 0em;margin-bottom: 1em;" class="h1_log">初めての方はこちら</h1>
        <form action="register.php" method="post" class="form_log">
          <!--<label for="email" class="label">メールアドレス</label><br>-->
          <input type="email" name="email" class="textbox un" placeholder="メールアドレス"><br>
          <!--<label for="password" class="label">パスワード</label><br>-->
          <input type="password" name="password" class="textbox pass" placeholder="パスワード"><br>
          <button type="submit" class="log_button">新規登録する</button>
          <p style="text-align:center;margin-top: 1.5em;">※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
        </form>
      </main>
    </body>
<?php
    return false;
  }
}
?>

<?php
include './layout/header.php';
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
    <button type="submit" name="register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">新規登録する</button>
  </form>
</div>

<?php include './layout/footer.php'; ?>
