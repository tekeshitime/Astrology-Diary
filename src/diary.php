<?php
session_start();
require_once('config.php');

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "SELECT * FROM userdeta
INNER JOIN post
ON userdeta.id = post.username;";

  $stmt = $pdo->query($sql);

  foreach ($stmt as $record) {
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}


?>

<?php include './layout/header.php'; ?>


<!-- 日記を追加するボタン -->
<div class="text-center">
  <button type="button" class="text-white w-96 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
    <a href="post_form.php" class="block">+日記を追加する</a></button>
</div>

<!-- 日付 -->
<h2 class="text-center my-4 text-3xl font-extrabold text-gray-400 leading-none tracking-tight md:text-4xl dark:text-white">
  2023年11月</h2>
</p>

<!-- 日記をカードで表示 -->

<div class="font-normal text-gray-700  mx-auto w-2/3 dark:text-gray-400">

  <a href="view_post.php" class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

    <!-- column 1 -->
    <div class="flex items-center">
      <div class="grid grid-cols-1 h-40 w-3/6 text-center ">
        <!-- 絵文字で表情 -->
        <div class="mood text-6xl">php</div>
        <!-- 曜日と日付 -->
        <div class="date">
          <?php
          $date = new DateTime($record['date']);
          echo $date->format('D');
          echo " ";
          echo $record['day'];
          ?>日
        </div>
        <!-- 太陽の星座 -->
        <div class="sign_sun_day">太陽：蠍座</div>
        <!-- 月の星座 -->
        <div class="sign_sun_day">月：蠍座</div>
      </div>
      <!-- column 2 -->
      <div class="border-l-2 pl-8">
        <!-- 今日やったこと add_activity -->
        <!-- <div class="add_activity"></div> -->
        <!-- 日記本文 max-3行-->
        <p class="">今日は自分を振り返る日だった。仕事では良い成果を出せたが、感情の面ではちょっと疲れ気味。もっとリラックスする時間を作るべきだなと感じた。明日からは自分にもっと優しく過ごそう。</p>
        <!-- 主要なアスペクト -->
        <span class="block my-2 text-sm leading-6 font-semibold text-blue-500 dark:text-sky-400">主要なアスペクト</span>
        <div class="relative">
          <table class="w-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
              <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800  dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  太陽
                </th>
                <td class="px-6 py-4">
                  □
                </td>
                <td class="px-6 py-4">
                  月
                </td>
                <td class="px-6 py-4">
                  6.3
                </td>
              </tr>
              <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  太陽
                </th>
                <td class="px-6 py-4">
                  □
                </td>
                <td class="px-6 py-4">
                  月
                </td>
                <td class="px-6 py-4">
                  6.3
                </td>
              </tr>
              <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800  dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  天王星
                </th>
                <td class="px-6 py-4">
                  □
                </td>
                <td class="px-6 py-4">
                  冥王星
                </td>
                <td class="px-6 py-4">
                  6.3
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </a>
  <!-- 編集リンク -->
  <p class="text-right mt-2">
    <span class="material-symbols-outlined">
      <a href="edit_form.php">edit_note</a>
    </span>
  </p>
</div>

<?php include './layout/footer.php'; ?>