<?php
session_start();
// ログイン状態を確認
if (!isset($_SESSION['authentication'])) {
  // ログインされていない場合、login.php へリダイレクト
  header("Location: login.php");
  exit();
}
?>

<?php
require_once('config.php');
include './layout/header.php';
?>

<?php
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "SELECT * FROM userDeta
  INNER JOIN capitals
  ON userDeta.place = capitals.name";

  $stmt = $pdo->query($sql);
  foreach ($stmt as $record) {
  }
} catch (PDOException $e) {
  echo "エラーメッセージ : " . $e->getMessage();
}
?>

<div class="max-w-screen-md mx-auto p-4 md:p-8">
  <div class="my-5 text-center">
    <p class="text-4xl font-bold">今日のトランジット</p>
  </div>
  <div class="my-10">

    <?php
    include './synastry/synastry_generator.php';

    echo "<center>";
    $wheel_img_src = 'synastry/synastry_wheel.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&ubt1=$ubt1&ubt2=$ubt2&l1=$line1&l2=$line2';
    echo "<img border='0' src='synastry/synastry_wheel.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&ubt1=$ubt1&ubt2=$ubt2&l1=$line1&l2=$line2' width='$wheel_width' height='$wheel_height'>";

    echo "<br><br>";

    $grid_img_src = 'synastry/synastry_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2';
    echo "<img border='0' src='synastry/synastry_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='830' height='475'>";

    echo "<br>";

    //ここからアスペクトの詳細
    echo '<center><table width="" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr>';
    echo "<td><font color='#0000ff'><b> T天体</b></font></td>";
    echo "<td><font color='#0000ff'><b> アスペクト </b></font></td>";
    echo "<td><font color='#0000ff'><b> N天体</b></font></td>";
    echo "<td><font color='#0000ff'><b> オーブ </b></font></td>";
    echo '</tr>';

    // include Ascendant and MC
    $longitude1[LAST_PLANET + 1] = $hc1[1];
    $longitude1[LAST_PLANET + 2] = $hc1[10];

    $pl_name[LAST_PLANET + 1] = "Ascendant";
    $pl_name[LAST_PLANET + 2] = "Midheaven";

    $longitude2[LAST_PLANET + 1] = $hc2[1];
    $longitude2[LAST_PLANET + 2] = $hc2[10];

    if ($ubt1 == 1) {
      $a1 = SE_TNODE;
    } else {
      $a1 = LAST_PLANET + 2;
    }

    if ($ubt2 == 1) {
      $b1 = SE_TNODE;
    } else {
      $b1 = LAST_PLANET + 2;
    }

    //ここからアスペクト計算表
    //--
    //--

    print_r(array_filter($aspect_tables));



    // ここからトランジットとネイタルのハウス情報など
    echo '<center><table  cellpadding="0" cellspacing="0" border="0" class="mt-10">';

    echo '<tr>';
    echo "<td><font color='#0000ff'><b> T天体</b></font></td>";
    echo "<td><font color='#0000ff'><b> 詳細 </b></font></td>";
    echo "<td><font color='#0000ff'><b> ハウス </b></font></td>";
    echo "<td><font color='#0000ff'class='ml-4'><b> N天体 </b></font></td>";
    echo "<td><font color='#0000ff'><b> 詳細 </b></font></td>";
    echo "<td><font color='#0000ff'><b> ハウス </b></font></td>";
    echo '</tr>';



    //アスペクトグリットの下部
    for ($i = 0; $i <= SE_PLUTO; $i++) {
      echo '<tr>';
      echo "<td>" . $pl_name[$i] . "</td>";

      echo "<td><font face='Courier New'>" . Convert_Longitude($longitude1[$i]) . " " . Mid($rx1, $i + 1, 1) . "</font></td>";
      if ($ubt1 == 1) {
        echo "<td>&nbsp;</td>";
      } else {
        $hse = floor($house_pos1[$i]);
        if ($hse < 10) {
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp; " . $hse . "</td>";
        } else {
          echo "<td>&nbsp;&nbsp;&nbsp;" . $hse . "</td>";
        }
      }

      echo "<td class='ml-4 block'>" . $pl_name[$i] . "</td>";
      echo "<td><font face='Courier New'>" . Convert_Longitude($longitude2[$i]) . " " . Mid($rx2, $i + 1, 1) . "</font></td>";
      if ($ubt2 == 1) {
        echo "<td>&nbsp;</td>";
      } else {
        $hse = floor($house_pos2[$i]);
        if ($hse < 10) {
          echo "<td >&nbsp;&nbsp;&nbsp;&nbsp; " . $hse . "</td>";
        } else {
          echo "<td>&nbsp;&nbsp;&nbsp;" . $hse . "</td>";
        }
      }

      echo '</tr>';
    }

    echo '<tr>';
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo '</tr>';





    echo '</table></center>';
    echo "<br><br>";
    ?>


  </div>
</div>

<?php include './layout/footer.php'; ?>