<?php
session_start();
require_once('config.php');

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "SELECT * FROM userdeta
          INNER JOIN post ON userdeta.id = post.username
          INNER JOIN mst_mood ON post.mood = mst_mood.mood_id;";
  $stmt = $pdo->query($sql);
  // $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($stmt as $record) {
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}
?>

<?php include './layout/header.php'; ?>



<!-- 日付 -->
<h2 class="text-center my-4 text-3xl font-extrabold text-gray-400 leading-none tracking-tight md:text-4xl dark:text-white">
  <!-- 2023年11月 -->
</h2>
</p>

<!-- 日記をカードで表示 -->
<?php
$sql = "SELECT * FROM post LIMIT 5;";
$stmt = $pdo->query($sql);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="font-normal text-gray-700  mx-auto w-2/3 dark:text-gray-400 block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
  <div class="flex items-center">
    <!-- column 1 -->
    <div class="grid grid-cols-1 h-40 w-2/6 text-center ">
      <div class="mood text-6xl "><!-- 絵文字で表情 -->
        <?php echo $record['mood']; ?>
      </div>
      <div class="date "><!-- 曜日と日付 -->
        <?php
        $week = array("日", "月", "火", "水", "木", "金", "土");
        $date = new DateTime($record['date']);
        echo $week[$date->format('w')] . "曜日";
        echo " ";
        echo $date->format('d');
        ?>日
      </div>
      <!-- 太陽の星座 -->
      <div class="sign_sun_day">太陽：
        <?php echo $record['day_sun']; ?>
      </div>
      <!-- 月の星座 -->
      <div class="sign_sun_day">月
        <?php echo $record['day_moon']; ?>
      </div>
    </div>
    <!-- column 2 -->
    <div class="border-l-2 pl-8 w-4/6 items-center">
      <p class="text-gray-300 font-bold"><?php echo $record['date']; ?></p>
      <!-- 今日やったこと add_activity -->
      <!-- <div class="add_activity"></div> -->
      <p class="text-ellipsis">
        <!-- 日記本文 max-3行-->
        <?php echo $record['content']; ?>
      </p>

      <!-- 
          $asp_glyph[1] = 113;    //  0 deg
          $asp_glyph[2] = 119;    //180 deg
          $asp_glyph[3] = 101;    //120 deg
          $asp_glyph[4] = 114;    // 90 deg
          $asp_glyph[5] = 111;    //150 deg
          $asp_glyph[6] = 116;    // 60 deg
         -->

      <!-- 主要なアスペクト -->
    </div>
  </div>
</div>

<div class="flex items-start">
  <div class="w-5/6">
    <div class="mt-4 "><?php echo $record['wheel_img_src'] ?></div>
    <div class="mt-4"><?php echo $record['grid_img_src'] ?></div>
  </div>
  <div class="table">
    <span class="block my-2 text-sm leading-6 font-semibold text-blue-500 dark:text-sky-400">
      アスペクト</span>
    <div class="relative">
      <table class="w-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <tbody>

          <?php
          // PHPのリストに変換
          $phpList[] = json_decode($record['aspect_desc'], true);

          // リストの中身を出力して確認
          // print_r($phpList[0]);
          // echo $phpList[0][2];

          if (is_array($phpList)) {
            for ($i = 0; $i < count($phpList[0]); $i++) {
              $front_aspect[$i] = $phpList[0][$i];
            }
          } else {
            echo "Error: Aspects is not an array.";
          }
          foreach ($front_aspect as $items) {
            $items = explode('-', $items);
            // print_r($items);
            echo '<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800  dark:border-gray-700"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">';
            echo $items[0];
            echo '</th><td class="px-6 py-4 aspect">';
            echo $items[1];
            echo '</td><td class="px-6 py-4">';
            echo $items[2];
            echo '</td><td class="px-6 py-4">';
            echo $items[3];
            echo '</td></tr>';
          }
          ?>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- 編集リンク -->
    <p class="text-right mt-2">
      <span class="material-symbols-outlined">
        <a href="edit_form">edit_note</a>
      </span>
    </p>
  </div>
</div>

<?php include './layout/footer.php'; ?>