<?php
session_start();
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
        username varchar(255),
        birth_day varchar(255),
        birth_time varchar(255),
        place varchar(255),
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
  //送信された内容を格納する
  $username = $_POST['username'];
  $birth_day = $_POST['birth_day'];
  $birth_time = $_POST['birth_time'];
  $place = $_POST['place'];
  //データベース内のメールアドレスを取得
  $stmt = $pdo->prepare("select email from userDeta where email = ?");
  $stmt->execute([$email]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  //データベース内のメールアドレスと重複していない場合、登録する。
  if (!isset($row['email'])) {
    $stmt = $pdo->prepare(
      "insert into userDeta(email, password,username,birth_day,birth_time,place)
      value(?,?,?,?,?,?)"
    );
    $stmt->execute([$email, $password, $username, $birth_day, $birth_time, $place]);
    echo '登録完了しました。<a href="login.php">ログイン</a>してください。';
    $_SESSION['authentication'] = true;
    $_SESSION['user_id'] = $email;
  } else {
    echo '既に登録されたメールアドレスです';
    return false;
  }
}
?>

<?php
include './layout/header.php';
?>

<div class="max-w-screen-sm mx-auto p-4 md:p-8">
  <form action="" method="POST">
    <!-- アドレス -->
    <div class="mb-6">
      <label for="signin-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
      <input name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@uraura.blog" required>
    </div>
    <!-- パスワード -->
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">パスワード</label>
      <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>


    <!-- ユーザーネーム -->
    <div class="mb-6">
      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        ユーザーネーム<span class="ml-4 text-sm text-blue-600">マイページに表示される名前</span></label>
      <input type="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="すかるの" required>
    </div>
    <!-- 生年月日 -->
    <div class="flex">
      <div class="mb-6">
        <label for="birth_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">生年月日</label>
        <input type="date" name="birth_day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
      </div>

      <!-- 出生時間 -->
      <div class="mb-6 ml-4">
        <label for="birth_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          出生時間<span class="ml-4 text-sm text-blue-600">不明なら12:00</span></label>
        <input type="time" name="birth_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
      </div>
    </div>
    <!-- 出生地 -->
    <div class="mb-6">
      <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">出生地<span class="ml-4 text-sm text-blue-600">最も近い都市を選択してください。</span></label>

      <select type="select" name="place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        <?php
        // 都道府県のリスト
        include './city.php';

        // 選択ボックスを生成
        foreach ($prefectures as $prefecture) {
          echo "<option value=\"$prefecture\">$prefecture</option>";
        }
        ?>
      </select>

    </div>
    <button type="submit" name="register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">新規登録する</button>
  </form>

  <div class="mt-4">
    <span>アカウントをお持ちの方</span><a href="login.php" class="ml-2">ログイン</a>
  </div>
</div>


<?php include './layout/footer.php'; ?>
