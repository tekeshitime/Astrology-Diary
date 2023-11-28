<?php
//$error_reporting = error_reporting(E_ALL & ~E_NOTICE);

use Symfony\Component\VarDumper\VarDumper;

$error_reporting = error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
date_default_timezone_set('America/Denver');
$server_name = strtolower($_SERVER['SERVER_NAME']);

$h_sys = "P";

include('birth_data.php');

//=============================================================================================

if (strtolower($ew) == "w") {
  $ew = -1;
  $ew_txt = "w";
} else {
  $ew = 1;
  $ew_txt = "e";
}

if (strtolower($ns) == "n") {
  $ns = 1;
  $ns_txt = "n";
} else {
  $ns = -1;
  $ns_txt = "s";
}

//=============================================================================================

$swephsrc = '/var/www/html/src/master_wheel/sweph';
$sweph = '/var/www/html/src/master_wheel/sweph';

putenv("PATH=$PATH:$swephsrc");

if (strlen($h_sys) != 1) {
  $h_sys = "P";
}

if ($lat_deg >= 66) {
  $h_sys = "O";
}

//unset any variables not initialized elsewhere in the program
unset($PATH, $out, $pl_name, $longitude1, $house_pos);

//assign data from database to local variables
$inmonth = $record["birth_m"];
$inday = $record["birth_d"];
$inyear = $record["birth_y"];

$inhours = $record["birth_hour"];
$inmins = $record["birth_min"];
$insecs = "0";

$intz = $record['timezone'];
// $intz = $timezone;

$my_latitude = $record['latitude'];
$my_longitude = $record['longitude'];

// $my_longitude = $ew * ($long_deg + ($long_min / 60));
// $my_latitude = $ns * ($lat_deg + ($lat_min / 60));

$abs_tz = abs($intz);
$the_hours = floor($abs_tz);
$fraction_of_hour = $abs_tz - floor($abs_tz);
$the_minutes = 60 * $fraction_of_hour;
$whole_minutes = floor(60 * $fraction_of_hour);
$fraction_of_minute = $the_minutes - $whole_minutes;
$whole_seconds = round(60 * $fraction_of_minute);

if ($intz >= 0) {
  $inhours = $inhours - $the_hours;
  $inmins = $inmins - $whole_minutes;
  $insecs =  $insecs - $whole_seconds;
  $tz_txt = "+" . $intz;
} else {
  $inhours = $inhours + $the_hours;
  $inmins = $inmins + $whole_minutes;
  $insecs =  $insecs + $whole_seconds;
  $tz_txt = $intz;
}


//adjust date and time for minus hour due to time zone taking the hour negative
$utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
$utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));

exec("swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out);

foreach ($out as $key => $line) {
  $row = explode(',', $line);
  $longitude1[$key] = $row[0];
  $speed1[$key] = $row[1];
  $house_pos1[$key] = $row[2];
};


include("constants.php");         // this is here because we must rename the planet names


//calculate the Part of Fortune - is this a day chart or a night chart?
if ($longitude1[LAST_PLANET + 1] > $longitude1[LAST_PLANET + 7]) {
  $day_chart = False;
  if ($longitude1[0] <= $longitude1[LAST_PLANET + 1] and $longitude1[0] > $longitude1[LAST_PLANET + 7]) {
    $day_chart = True;
  }
} else {
  $day_chart = True;
  if ($longitude1[0] > $longitude1[LAST_PLANET + 1] and $longitude1[0] <= $longitude1[LAST_PLANET + 7]) {
    $day_chart = False;
  }
}

$longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] - $longitude1[1] + $longitude1[0];
if ($day_chart == True) {
  $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] + $longitude1[1] - $longitude1[0];
}

if ($longitude1[SE_POF] >= 360) {
  $longitude1[SE_POF] = $longitude1[SE_POF] - 360;
}
if ($longitude1[SE_POF] < 0) {
  $longitude1[SE_POF] = $longitude1[SE_POF] + 360;
}

//capture the Vertex longitude
$longitude1[LAST_PLANET] = $longitude1[LAST_PLANET + 16];   //Asc = +13, MC = +14, RAMC = +15, Vertex = +16

if ($ubt == 1) {
  $longitude1[1 + LAST_PLANET] = 0;       //make flat chart with natural houses
  $longitude1[2 + LAST_PLANET] = 30;
  $longitude1[3 + LAST_PLANET] = 60;
  $longitude1[4 + LAST_PLANET] = 90;
  $longitude1[5 + LAST_PLANET] = 120;
  $longitude1[6 + LAST_PLANET] = 150;
  $longitude1[7 + LAST_PLANET] = 180;
  $longitude1[8 + LAST_PLANET] = 210;
  $longitude1[9 + LAST_PLANET] = 240;
  $longitude1[10 + LAST_PLANET] = 270;
  $longitude1[11 + LAST_PLANET] = 300;
  $longitude1[12 + LAST_PLANET] = 330;
}


//get house positions of planets here
for ($x = 1; $x <= 12; $x++) {
  for ($y = 0; $y <= LAST_PLANET; $y++) {
    $pl = $longitude1[$y] + (1 / 36000);

    if ($x < 12 and $longitude1[$x + LAST_PLANET] > $longitude1[$x + LAST_PLANET + 1]) {
      if (($pl >= $longitude1[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude1[$x + LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos1[$y] = $x;
        continue;
      }
    }

    if ($x == 12 and ($longitude1[$x + LAST_PLANET] > $longitude1[LAST_PLANET + 1])) {
      if (($pl >= $longitude1[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude1[LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos1[$y] = $x;
      }
      continue;
    }

    if (($pl >= $longitude1[$x + LAST_PLANET]) and ($pl < $longitude1[$x + LAST_PLANET + 1]) and ($x < 12)) {
      $house_pos1[$y] = $x;
      continue;
    }

    if (($pl >= $longitude1[$x + LAST_PLANET]) and ($pl < $longitude1[LAST_PLANET + 1]) and ($x == 12)) {
      $house_pos1[$y] = $x;
    }
  }
}


// echo "<center>";

// // $restored_name = stripslashes($name);
// // echo "<font color='#ff0000' size='5' face='Arial'><b>Name = " . $record["username"] . " </b></font><br><br>";

// $secs = "0";
// if ($timezone < 0) {
//   $tz = $timezone;
// } else {
//   $tz = "+" . $timezone;
// }

// $h_sys_txt = "Placidus";

// echo "<font size='4' face='arial'><b>Born " . strftime("%A, %B %d, %Y<br>%X (time zone = GMT $tz hours)</b></font><br>\n", mktime(intval($hour), intval($minute), intval($secs), intval($month), intval($day), intval($year)));
// echo "<font size='3' face='arial'><b>" . $long_deg . $ew_txt . sprintf("%02d", $long_min) . ", " . $lat_deg . $ns_txt . sprintf("%02d", $lat_min) . ", house system = " . $h_sys_txt . "</b></font><br><br>";

// echo "</center>";

$rx1 = "";
for ($i = 0; $i <= SE_TNODE; $i++) {
  if ($speed1[$i] < 0) {
    $rx1 .= "R";
  } else {
    $rx1 .= " ";
  }
}

for ($i = 1; $i <= 12; $i++) {
  $hc1[$i] = $longitude1[LAST_PLANET + $i];
}

$ser_L1 = serialize($longitude1);
$ser_L2 = serialize($longitude1);
$ser_hc1 = serialize($hc1);
$ser_hpos = serialize($house_pos1);

echo "<center>";
echo "<img border='0' src='master_wheel/natal_wheel.php?rx1=$rx1&p1=$ser_L1&hc1=$ser_hc1&hpos=$ser_hpos&ubt1=$ubt'>";

echo "<br>";
include('footer.html');
echo "</center>";
