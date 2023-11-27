<?php
session_start();


// ログイン状態を確認
if (!isset($_SESSION['authentication'])) {
  // ログインされていない場合、ログイン画面を表示
  include 'login.php';
  exit();
}
require_once('db.php');

$record = getLoggedinUser();
if (isset($_POST['update'])) {
  // editLoggedInUser 関数を呼び出す
  editLoggedInUser();
}
?>

<?php require_once './layout/header.php'; ?>
<div class="max-w-screen-md mx-auto p-4 md:p-8">
  <form action="" method="POST">
    <!-- アドレス -->
    <div class="mb-6">
      <label for="signin-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">メールアドレス</label>
      <input name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['email'] ?>" required>
    </div>



    <!-- ユーザーネーム -->
    <div class="mb-6">
      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        ユーザーネーム<span class="ml-4 text-sm text-blue-600">マイページに表示される名前</span></label>
      <input type="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['username'] ?>" required>
    </div>
    <!-- 生年月日 -->
    <div class="flex">
      <div class="mb-6">
        <label for="birth_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">生年月日</label>
        <input type="number" name="birth_y" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['birth_y'] ?>" required>
        <input type="number" name="birth_m" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['birth_m'] ?>" required>
        <input type="number" name="birth_d" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['birth_d'] ?>" required>
      </div>

      <!-- 出生時間 -->
      <div class="mb-6 ml-4">
        <label for="birth_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          出生時間<span class="ml-4 text-sm text-blue-600">不明なら12:00</span></label>
        <input type="number" name="birth_hour" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['birth_hour'] ?>" required>
        <input type="number" name="birth_min" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $record['birth_min'] ?>" required>
      </div>
    </div>
    <!-- 出生地 -->
    <div class="mb-6">
      <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        出生地<span class=" ml-4 text-sm text-blue-600">最も近い都市を選択してください。</span></label>

      <select type="select" name="place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        <?php
        // 都道府県のリスト
        include './city.php';

        // 選択ボックスを生成
        foreach ($prefectures as $prefecture) {
          $selected = ($prefecture === $record['place']) ? 'selected' : '';
          echo "<option value=\"$prefecture\" $selected>$prefecture</option>";
        }
        ?>

      </select>
    </div>
    <button type="submit" name="update" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">プロフィールを修正する</button>
  </form>


</div>

<?php include './layout/footer.php'; ?>