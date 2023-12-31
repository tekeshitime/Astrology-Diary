<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['authentication'])) {
  // ログインされていない場合、login.php へリダイレクト
  header("Location: login");
  exit();
}

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "SELECT * FROM userdeta
          INNER JOIN post ON userdeta.id = post.username;";

  $stmt = $pdo->query($sql);

  foreach ($stmt as $record) {
    // print_r($record);
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}


?>

<?php include './layout/header.php'; ?>


<!-- 日記を追加するボタン -->
<div class="text-center">
  <button type="button" class="text-white w-96 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
    <a href="post_form" class="block">+日記を追加する</a></button>
</div>

<!-- 日付 -->
<h2 class="text-center my-4 text-3xl font-extrabold text-gray-400 leading-none tracking-tight md:text-4xl dark:text-white">
  <!-- 2023年11月 -->
</h2>
</p>

<!-- 日記をカードで表示 -->
<?php
$userId = $_SESSION['id'];
$sql = "SELECT * FROM post 
INNER JOIN mst_mood ON post.mood = mst_mood.mood_id
where username = $userId
ORDER BY date desc LIMIT 5";

$stmt = $pdo->query($sql);
$record = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($record as $record) {
  unset($phpList);
?>
  <div class="font-normal text-gray-700  mx-auto w-2/3 dark:text-gray-400">
    <!-- 編集リンク -->
    <p class="text-right inline mt-2">
    <form action="post_edit" action="get">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>" />
      <input type="submit" value="edit_note" class="material-symbols-outlined">
    </form>
    </p>
    <a href="post_view" class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
      <div class="flex items-center">
        <!-- column 1 -->
        <div class="grid grid-cols-1 h-40 w-2/6 text-center ">
          <div class="mood text-6xl "><!-- 絵文字で表情 -->
            <?php echo htmlspecialchars($record['mood'], ENT_QUOTES); ?>
          </div>
          <div class="date "><!-- 曜日と日付 -->
            <?php
            $week = array("日", "月", "火", "水", "木", "金", "土");
            $date = new DateTime($record['date']);
            echo htmlspecialchars($week[$date->format('w')], ENT_QUOTES) . "曜日 ";
            echo htmlspecialchars($date->format('d'));
            ?>日
          </div>
          <!-- 太陽の星座 -->
          <div class="sign_sun_day">太陽：
            <?php echo htmlspecialchars($record['day_sun']) ?>座
          </div>
          <!-- 月の星座 -->
          <div class="sign_sun_day">月：
            <?php echo htmlspecialchars($record['day_moon']) ?>座
          </div>
        </div>
        <!-- column 2 -->
        <div class="border-l-2 pl-8 w-4/6">
          <p class="text-gray-300 font-bold"><?php echo htmlspecialchars($record['date']) ?></p>

          <!-- 今日やったこと add_activity -->
          <!-- <div class="add_activity"></div> -->
          <p class="text-ellipsis">
            <!-- 日記本文 max-3行-->
            <?php echo htmlspecialchars($record['content']); ?>
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
          <span class="block my-2 text-sm leading-6 font-semibold text-blue-500 dark:text-sky-400">アスペクト</span>
          <div class="relative">
            <table class="w-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <tbody>

                <?php
                // PHPのリストに変換
                $phpList[] = json_decode($record['aspect_desc'], true);

                if (is_array($phpList)) {
                  for ($i = 0; $i < 3; $i++) {
                    $front_aspect[$i] = $phpList[0][$i];
                  }
                } else {
                  echo "Error: Aspects is not an array.";
                }
                // var_dump($front_aspect);
                foreach ($front_aspect as $items) {
                  $items = explode('-', $items);
                  // print_r($items);
                  echo '<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800  dark:border-gray-700"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">';
                  echo htmlspecialchars($items[0]);
                  echo '</th><td class="px-6 py-4 aspect">';
                  echo htmlspecialchars($items[1]);
                  echo '</td><td class="px-6 py-4">';
                  echo htmlspecialchars($items[2]);
                  echo '</td><td class="px-6 py-4">';
                  echo htmlspecialchars($items[3]);
                  echo '</td></tr>';
                }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </a>

  </div>
<?php
}
?>

<?php include './layout/footer.php'; ?>