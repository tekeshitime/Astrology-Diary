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
  $sql = "SELECT * FROM userdeta
  INNER JOIN mst_capitals
  ON userdeta.place = mst_capitals.name";

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

    echo "<img border='0' src='synastry/synastry_wheel.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&ubt1=$ubt1&ubt2=$ubt2&l1=$line1&l2=$line2' width='$wheel_width' height='$wheel_height'>";

    echo "<br><br>";


    echo "<img border='0' src='synastry/synastry_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='830' height='475'>";

    echo "<br>";





    // ここからトランジットとネイタルのハウス情報など
    // 自分の太陽から火星までを対象とする。
    // トランジットの木星から冥王星までを対象とする。
    echo '<center><table  cellpadding="0" cellspacing="0" border="0" class="mt-10">';

    echo '<tr>';
    echo "<td><font color='#0000ff'><b> N天体</b></font></td>";
    echo "<td><font color='#0000ff'><b> 詳細 </b></font></td>";
    echo "<td><font color='#0000ff'><b> ハウス </b></font></td>";
    echo "<td><font color='#0000ff'class='ml-4'><b> T天体 </b></font></td>";
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

    //ここからアスペクトの詳細
    echo '<center><table width="" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr>';
    echo "<td><font color='#0000ff'><b> N天体</b></font></td>";
    echo "<td><font color='#0000ff'><b> アスペクト </b></font></td>";
    echo "<td><font color='#0000ff'><b> T天体</b></font></td>";
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

    for ($i = 0; $i <= SE_MARS; $i++) {
      for ($j = SE_JUPITER; $j <= SE_PLUTO; $j++) {
        $q = 0;
        $da = Abs($longitude2[$i] - $longitude1[$j]);

        if ($da > 180) {
          $da = 360 - $da;
        }

        // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
        if ($i == SE_POF or $j == SE_POF) {
          $orb = 2;
          // } elseif ($i == SE_LILITH or $j == SE_LILITH) {
          //   $orb = 3;
          // } elseif ($i == SE_TNODE or $j == SE_TNODE) {
          //   $orb = 3;
          // } elseif ($i == SE_VERTEX or $j == SE_VERTEX) {
          //   $orb = 3;
        } elseif ($i == SE_SUN or $i == SE_MOON or $j == SE_SUN or $j == SE_MOON) {
          $orb = 8;
        } else {
          $orb = 6;
        }

        // is there an aspect within orb?
        if ($da <= $orb) {
          $q = 1;
          $dax = $da;
        } elseif (($da <= (60 + $orb)) and ($da >= (60 - $orb))) {
          $q = 6;
          $dax = $da - 60;
        } elseif (($da <= (90 + $orb)) and ($da >= (90 - $orb))) {
          $q = 4;
          $dax = $da - 90;
        } elseif (($da <= (120 + $orb)) and ($da >= (120 - $orb))) {
          $q = 3;
          $dax = $da - 120;
        } elseif (($da <= (150 + $orb)) and ($da >= (150 - $orb))) {
          $q = 5;
          $dax = $da - 150;
        } elseif ($da >= (180 - $orb)) {
          $q = 2;
          $dax = 180 - $da;
        }

        if ($q > 0) {
          $final_dax = sprintf("%.2f", abs($dax));
          // $i　ネイタル金星まで
          // $j トランジット木星から
          echo "<tr>
                  <td>" . $pl_name[$i] . "</td>
                  <td>" . $asp_name[$q] . "</td>
                  <td>" . $pl_name[$j] . "</td>
                  <td>" . $final_dax . "</td>
                </tr>";
        }
      }
    }





    echo '</table></center>';
    echo "<br><br>";
    ?>


  </div>
</div>

<?php include './layout/footer.php'; ?>