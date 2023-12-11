<?php
session_start();
require_once('config.php');
if (isset($_POST['post'])) {
    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $date = $_POST['date'];
        $stmt = $pdo->prepare("SELECT `date` FROM post WHERE `date` = ?");
        $stmt->execute([$date]);
        if ($stmt->rowCount() == 0) {
            $sql = "SELECT * FROM userdeta
                    INNER JOIN mst_capitals
                    ON userdeta.place = mst_capitals.name";
            $session_stmt = $pdo->query($sql);
            foreach ($session_stmt as $record) {
            }
            $stmt = $pdo->prepare(
                "INSERT INTO post(`username`, `mood`, `content`, `date`, `wheel_img_src`, `grid_img_src`, `day_sun`, `day_moon`, `aspect_desc`)
                VALUES (?,?,?,?,?,?,?,?,?)"
            );

            // ホロスコープ情報を追加する
            include './synastry/synastry_generator.php';
            $stmt->execute([$_SESSION['id'], $_POST['mood'], $_POST['content'], $_POST['date'], $wheel_img_src, $grid_img_src, $day_sun, $day_moon, json_encode($parts_aspects)]);
            unset($_POST['date']);
            header("Location: diary");
        } else {
            $message = "<p class='text-red-600 font-bold'>以下日付の日記はすでに存在しています。</p>";
        }
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}

?>


<?php include './layout/header.php'; ?>

<form class="max-w-screen-md mx-auto p-4 md:p-8" method="post">
    <p class="text-sm text-gray-800 dark:text-white">希望の日付に変更できます。</p>
    <?php
    echo $message;
    ?>
    <div class="text-5xl font-bold text-gray-400">
        <input type="date" name="date" id="selectdate" value="<?php echo date('Y-m-d'); ?>" class='text-gray-800 dark:text-white'>
    </div>


    <div class="flex h-40 items-center">
        <p class="text-sm">感情</p>
        <div class="flex items-center">
            <input id="mood-1" type="radio" value="1" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
            <label for="mood-1" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😱</label>
        </div>
        <div class="flex items-center">
            <input id="mood-2" type="radio" value="2" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
            <label for="mood-2" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😥</label>
        </div>
        <div class="flex items-center">
            <input checked id="mood-3" type="radio" value="3" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
            <label for="mood-3" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😀</label>
        </div>
        <div class="flex items-center">
            <input id="mood-4" type="radio" value="4" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
            <label for="mood-4" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">😋</label>
        </div>
        <div class="flex items-center">
            <input id="mood-5" type="radio" value="5" name="mood" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 relative bottom-10 left-12">
            <label for="mood-5" class="ms-2 text-6xl font-medium text-gray-900 dark:text-gray-300">🥰</label>
        </div>
    </div>

    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">今日はどんな一日だった？</label>
    <textarea id="message" rows="4" name="content" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="今日は新しいプロジェクトの計画を立てる日だった。目標はクリアになりつつあるが、まだ課題も多い。明日は早起きして集中して取り組もう。自分に厳しく、でも無理せず進んでいこう。"></textarea>

    <div class="text-center mt-4">
        <button type="submit" name="post" class="text-white w-96 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">日記を投稿する</button>
    </div>

</form>

<?php include './layout/footer.php'; ?>