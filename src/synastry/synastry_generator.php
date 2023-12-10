<?php

$months = array(0 => 'Choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$my_error = "";

$no_interps = False;        //set this to False when you want interpretations (you will have to supply your own)


$h_sys = safeEscapeString($_POST["h_sys"]);

// get all variables from form - Person #1
$name1 = safeEscapeString($_POST["name1"]);

$month1 = safeEscapeString($_POST["month1"]);
$day1 = safeEscapeString($_POST["day1"]);
$year1 = safeEscapeString($_POST["year1"]);

$hour1 = safeEscapeString($_POST["hour1"]);
$minute1 = safeEscapeString($_POST["minute1"]);

$timezone1 = safeEscapeString($_POST["timezone1"]);

$long_deg1 = safeEscapeString($_POST["long_deg1"]);
$long_min1 = safeEscapeString($_POST["long_min1"]);
$ew1 = safeEscapeString($_POST["ew1"]);

$lat_deg1 = safeEscapeString($_POST["lat_deg1"]);
$lat_min1 = safeEscapeString($_POST["lat_min1"]);
$ns1 = safeEscapeString($_POST["ns1"]);

// // set cookie containing natal data here
// setcookie('name', stripslashes($name1), time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('month', $month1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('day', $day1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('year', $year1, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('hour', $hour1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('minute', $minute1, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('timezone', $timezone1, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('long_deg', $long_deg1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('long_min', $long_min1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('ew', $ew1, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('lat_deg', $lat_deg1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('lat_min', $lat_min1, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('ns', $ns1, time() + 60 * 60 * 24 * 30, '/', '', 0);


// include("validation_class.php");

// //error check
// $my_form = new Validate_fields;

// $my_form->check_4html = true;

// $my_form->add_text_field("Name #1", $name1, "text", "y", 40);

// $my_form->add_text_field("Month #1", $month1, "text", "y", 2);
// $my_form->add_text_field("Day #1", $day1, "text", "y", 2);
// $my_form->add_text_field("Year #1", $year1, "text", "y", 4);

// $my_form->add_text_field("Hour #1", $hour1, "text", "y", 2);
// $my_form->add_text_field("Minute #1", $minute1, "text", "y", 2);

// $my_form->add_text_field("Time zone #1", $timezone1, "text", "y", 4);

// $my_form->add_text_field("Longitude degree #1", $long_deg1, "text", "y", 3);
// $my_form->add_text_field("Longitude minute #1", $long_min1, "text", "y", 2);
// $my_form->add_text_field("Longitude E/W #1", $ew1, "text", "y", 2);

// $my_form->add_text_field("Latitude degree #1", $lat_deg1, "text", "y", 2);
// $my_form->add_text_field("Latitude minute #1", $lat_min1, "text", "y", 2);
// $my_form->add_text_field("Latitude N/S #1", $ns1, "text", "y", 2);

// // additional error checks on user-entered data
// if ($month1 != "" and $day1 != "" and $year1 != "") {
//   if (!$date = checkdate($month1, $day1, $year1)) {
//     $my_error .= "The date of birth you entered is not valid.<br>";
//   }
// }

// if (($year1 < 1800) or ($year1 >= 2400)) {
//   $my_error .= "Birth year person #1 - please enter a year between 1800 and 2399.<br>";
// }

// if (($hour1 < 0) or ($hour1 > 23)) {
//   $my_error .= "Birth hour must be between 0 and 23.<br>";
// }

// if (($minute1 < 0) or ($minute1 > 59)) {
//   $my_error .= "Birth minute must be between 0 and 59.<br>";
// }

// if (($long_deg1 < 0) or ($long_deg1 > 179)) {
//   $my_error .= "Longitude degrees must be between 0 and 179.<br>";
// }

// if (($long_min1 < 0) or ($long_min1 > 59)) {
//   $my_error .= "Longitude minutes must be between 0 and 59.<br>";
// }

// if (($lat_deg1 < 0) or ($lat_deg1 > 65)) {
//   $my_error .= "Latitude degrees must be between 0 and 65.<br>";
// }

// if (($lat_min1 < 0) or ($lat_min1 > 59)) {
//   $my_error .= "Latitude minutes must be between 0 and 59.<br>";
// }

// if (($ew1 == '-1') and ($timezone1 > 2)) {
//   $my_error .= "You have marked West longitude but set an east time zone.<br>";
// }

// if (($ew1 == '1') and ($timezone1 < 0)) {
//   $my_error .= "You have marked East longitude but set a west time zone.<br>";
// }


// $ew1_txt = "e";
// if ($ew1 < 0) {
//   $ew1_txt = "w";
// }

// $ns1_txt = "s";
// if ($ns1 > 0) {
//   $ns1_txt = "n";
// }


// // get all variables from form - Person #2
// $name2 = safeEscapeString($_POST["name2"]);

// $month2 = safeEscapeString($_POST["month2"]);
// $day2 = safeEscapeString($_POST["day2"]);
// $year2 = safeEscapeString($_POST["year2"]);

// $hour2 = safeEscapeString($_POST["hour2"]);
// $minute2 = safeEscapeString($_POST["minute2"]);

// $timezone2 = safeEscapeString($_POST["timezone2"]);

// $long_deg2 = safeEscapeString($_POST["long_deg2"]);
// $long_min2 = safeEscapeString($_POST["long_min2"]);
// $ew2 = safeEscapeString($_POST["ew2"]);

// $lat_deg2 = safeEscapeString($_POST["lat_deg2"]);
// $lat_min2 = safeEscapeString($_POST["lat_min2"]);
// $ns2 = safeEscapeString($_POST["ns2"]);

// // set cookie containing natal data here
// setcookie('name2', stripslashes($name2), time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('month2', $month2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('day2', $day2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('year2', $year2, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('hour2', $hour2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('minute2', $minute2, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('timezone2', $timezone2, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('long_deg2', $long_deg2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('long_min2', $long_min2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('ew2', $ew2, time() + 60 * 60 * 24 * 30, '/', '', 0);

// setcookie('lat_deg2', $lat_deg2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('lat_min2', $lat_min2, time() + 60 * 60 * 24 * 30, '/', '', 0);
// setcookie('ns2', $ns2, time() + 60 * 60 * 24 * 30, '/', '', 0);

// // include('header_synastry.html');       //here because of setting cookies above

// // //error check
// // $my_form->add_text_field("Name #2", $name2, "text", "y", 40);

// // $my_form->add_text_field("Month #2", $month2, "text", "y", 2);
// // $my_form->add_text_field("Day #2", $day2, "text", "y", 2);
// // $my_form->add_text_field("Year #2", $year2, "text", "y", 4);

// // $my_form->add_text_field("Hour #2", $hour2, "text", "y", 2);
// // $my_form->add_text_field("Minute #2", $minute2, "text", "y", 2);

// // $my_form->add_text_field("Time zone #2", $timezone2, "text", "y", 4);

// // $my_form->add_text_field("Longitude degree #2", $long_deg2, "text", "y", 3);
// // $my_form->add_text_field("Longitude minute #2", $long_min2, "text", "y", 2);
// // $my_form->add_text_field("Longitude E/W #2", $ew2, "text", "y", 2);

// // $my_form->add_text_field("Latitude degree #2", $lat_deg2, "text", "y", 2);
// // $my_form->add_text_field("Latitude minute #2", $lat_min2, "text", "y", 2);
// // $my_form->add_text_field("Latitude N/S #2", $ns2, "text", "y", 2);

// // additional error checks on user-entered data
// if ($month2 != "" and $day2 != "" and $year2 != "") {
//   if (!$date = checkdate($month2, $day2, $year2)) {
//     $my_error .= "The date of birth you entered is not valid.<br>";
//   }
// }

// if (($year2 < 1800) or ($year2 >= 2400)) {
//   $my_error .= "Birth year person #2 - please enter a year between 1800 and 2399.<br>";
// }

// if (($hour2 < 0) or ($hour2 > 23)) {
//   $my_error .= "Birth hour must be between 0 and 23.<br>";
// }

// if (($minute2 < 0) or ($minute2 > 59)) {
//   $my_error .= "Birth minute must be between 0 and 59.<br>";
// }

// if (($long_deg2 < 0) or ($long_deg2 > 179)) {
//   $my_error .= "Longitude degrees must be between 0 and 179.<br>";
// }

// if (($long_min2 < 0) or ($long_min2 > 59)) {
//   $my_error .= "Longitude minutes must be between 0 and 59.<br>";
// }

// if (($lat_deg2 < 0) or ($lat_deg2 > 65)) {
//   $my_error .= "Latitude degrees must be between 0 and 65.<br>";
// }

// if (($lat_min2 < 0) or ($lat_min2 > 59)) {
//   $my_error .= "Latitude minutes must be between 0 and 59.<br>";
// }

// if (($ew2 == '-1') and ($timezone2 > 2)) {
//   $my_error .= "You have marked West longitude but set an east time zone.<br>";
// }

// if (($ew2 == '1') and ($timezone2 < 0)) {
//   $my_error .= "You have marked East longitude but set a west time zone.<br>";
// }


// $ew2_txt = "e";
// if ($ew2 < 0) {
//   $ew2_txt = "w";
// }

// $ns2_txt = "s";
// if ($ns2 > 0) {
//   $ns2_txt = "n";
// }


// $validation_error = $my_form->validation();

// if ((!$validation_error) || ($my_error != "")) {
//   // $error = $my_form->create_msg();
//   echo "<TABLE align='center' WIDTH='98%' BORDER='0' CELLSPACING='15' CELLPADDING='0'><tr><td><center><b>";
//   echo "<font color='#ff0000' size=+2>Error! - The following error(s) occurred:</font><br>";

//   if ($error) {
//     echo $error . $my_error;
//   } else {
//     echo $error . "<br>" . $my_error;
//   }

//   echo "</font>";
//   echo "<font color='#c020c0'";
//   echo "<br><br>PLEASE RE-ENTER YOUR TIME ZONE DATA. THANK YOU.<br><br>";
//   echo "</font>";
//   echo "</b></center></td></tr></table>";
// } else {
// no errors in filling out form, so process form
$swephsrc = './synastry/sweph';
$sweph = './synastry//sweph';

putenv("PATH=$PATH:$swephsrc");

if (strlen($h_sys) != 1) {
  $h_sys = "p";
}

//ネイタルチャート計算
// Unset any variables not initialized elsewhere in the program
unset($PATH, $out, $pl_name, $longitude1, $house_pos1);

// 今日の日付を出力する
date_default_timezone_set('Asia/Tokyo');
$today = getdate();

//assign data from database to local variables
$inmonth = $record['birth_m'];
$inday = $record['birth_d'];
$inyear = $record['birth_y'];


$inhours = $record['birth_hour'];
$inmins = $record['birth_min'];
$insecs = "0";

$intz = $record['timezone'];

$my_longitude = $record['longitude'];
$my_latitude = $record['latitude'];

$abs_tz = abs($intz);
$the_hours = floor($abs_tz);
$fraction_of_hour = $abs_tz - floor($abs_tz);
$the_minutes = 60 * $fraction_of_hour;
$whole_minutes = floor(60 * $fraction_of_hour);
$fraction_of_minute = $the_minutes - $whole_minutes;
$whole_seconds = round(60 * $fraction_of_minute);

// if ($intz >= 0) {
//   $inhours = $inhours - $the_hours;
//   $inmins = $inmins - $whole_minutes;
//   $insecs =  $insecs - $whole_seconds;
// } else {
//   $inhours = $inhours + $the_hours;
//   $inmins = $inmins + $whole_minutes;
//   $insecs =  $insecs + $whole_seconds;
// }

// adjust date and time for minus hour due to time zone taking the hour negative
$utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
$utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));

exec("swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -fldsj -g, -head", $out);   //add a planet

// Each line of output data from swetest is exploded into array $row, giving these elements:
// 0 = longitude
// 1 = speed
// 2 = house position
// planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
foreach ($out as $key => $line) {
  $row = explode(',', $line);
  $longitude1[$key] = $row[0];
  $declination1[$key] = $row[1];
  $speed1[$key] = $row[2];
  $house_pos1[$key] = $row[3];
};

include("constants.php");     // this is here because we must rename the planet names

//calculate the Part of Fortune
//is this a day chart or a night chart?
if ($longitude1[LAST_PLANET + 1] > $longitude1[LAST_PLANET + 7]) {
  if ($longitude1[0] <= $longitude1[LAST_PLANET + 1] and $longitude1[0] > $longitude1[LAST_PLANET + 7]) {
    $day_chart = True;
  } else {
    $day_chart = False;
  }
} else {
  if ($longitude1[0] > $longitude1[LAST_PLANET + 1] and $longitude1[0] <= $longitude1[LAST_PLANET + 7]) {
    $day_chart = False;
  } else {
    $day_chart = True;
  }
}

if ($day_chart == True) {
  $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] + $longitude1[1] - $longitude1[0];
} else {
  $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] - $longitude1[1] + $longitude1[0];
}

if ($longitude1[SE_POF] >= 360) {
  $longitude1[SE_POF] = $longitude1[SE_POF] - 360;
}

if ($longitude1[SE_POF] < 0) {
  $longitude1[SE_POF] = $longitude1[SE_POF] + 360;
}

//capture the Vertex longitude
$longitude1[LAST_PLANET] = $longitude1[LAST_PLANET + 16];   //Asc = +13, MC = +14, RAMC = +15, Vertex = +16

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


//トランジットチャートの計算
// Unset any variables not initialized elsewhere in the program
unset($out, $longitude2, $house_pos2);



$inmonth = $today['mon'];
$inday = $today['mday'];
$inyear = $today['year'];

if (isset($_POST['date'])) {
  list($inyear, $inmonth, $inday) = explode('-', $_POST['date']);
}
// echo $inyear;
// echo $inmonth;
// echo $inday;



$inhours = 12;
$inmins = 0;
$insecs = "0";

// $intz = $timezone2;

// $my_longitude = $ew2 * ($long_deg2 + ($long_min2 / 60));
// $my_latitude = $ns2 * ($lat_deg2 + ($lat_min2 / 60));

$abs_tz = abs($intz);
$the_hours = floor($abs_tz);
$fraction_of_hour = $abs_tz - floor($abs_tz);
$the_minutes = 60 * $fraction_of_hour;
$whole_minutes = floor(60 * $fraction_of_hour);
$fraction_of_minute = $the_minutes - $whole_minutes;
$whole_seconds = round(60 * $fraction_of_minute);

// if ($intz >= 0) {
//   $inhours = $inhours - $the_hours;
//   $inmins = $inmins - $whole_minutes;
//   $insecs =  $insecs - $whole_seconds;
// } else {
//   $inhours = $inhours + $the_hours;
//   $inmins = $inmins + $whole_minutes;
//   $insecs =  $insecs + $whole_seconds;
// }

// adjust date and time for minus hour due to time zone taking the hour negative
$utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
$utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
// var_dump($utdatenow);
exec("swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -fldsj -g, -head", $out);

// Each line of output data from swetest is exploded into array $row, giving these elements:
// 0 = longitude
// 1 = speed
// 2 = house position
// planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
foreach ($out as $key => $line) {
  $row = explode(',', $line);
  $longitude2[$key] = $row[0];
  $declination2[$key] = $row[1];
  $speed2[$key] = $row[2];
  $house_pos2[$key] = $row[3];
};

//運命の一部を計算する
//これは昼のチャートですか、それとも夜のチャートですか？
if ($longitude2[LAST_PLANET + 1] > $longitude2[LAST_PLANET + 7]) {
  if ($longitude2[0] <= $longitude2[LAST_PLANET + 1] and $longitude2[0] > $longitude2[LAST_PLANET + 7]) {
    $day_chart = True;
  } else {
    $day_chart = False;
  }
} else {
  if ($longitude2[0] > $longitude2[LAST_PLANET + 1] and $longitude2[0] <= $longitude2[LAST_PLANET + 7]) {
    $day_chart = False;
  } else {
    $day_chart = True;
  }
}

if ($day_chart == True) {
  $longitude2[SE_POF] = $longitude2[LAST_PLANET + 1] + $longitude2[1] - $longitude2[0];
} else {
  $longitude2[SE_POF] = $longitude2[LAST_PLANET + 1] - $longitude2[1] + $longitude2[0];
}

if ($longitude2[SE_POF] >= 360) {
  $longitude2[SE_POF] = $longitude2[SE_POF] - 360;
}

if ($longitude2[SE_POF] < 0) {
  $longitude2[SE_POF] = $longitude2[SE_POF] + 360;
}


//capture the Vertex longitude
$longitude2[LAST_PLANET] = $longitude2[LAST_PLANET + 16];


//get house positions of planets here
for ($x = 1; $x <= 12; $x++) {
  for ($y = 0; $y <= LAST_PLANET; $y++) {
    $pl = $longitude2[$y] + (1 / 36000);
    if ($x < 12 and $longitude2[$x + LAST_PLANET] > $longitude2[$x + LAST_PLANET + 1]) {
      if (($pl >= $longitude2[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude2[$x + LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos2[$y] = $x;
        continue;
      }
    }

    if ($x == 12 and ($longitude2[$x + LAST_PLANET] > $longitude2[LAST_PLANET + 1])) {
      if (($pl >= $longitude2[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude2[LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos2[$y] = $x;
      }
      continue;
    }

    if (($pl >= $longitude2[$x + LAST_PLANET]) and ($pl < $longitude2[$x + LAST_PLANET + 1]) and ($x < 12)) {
      $house_pos2[$y] = $x;
      continue;
    }

    if (($pl >= $longitude2[$x + LAST_PLANET]) and ($pl < $longitude2[LAST_PLANET + 1]) and ($x == 12)) {
      $house_pos2[$y] = $x;
    }
  }
}


//get house positions of planets here - person 2 planets in person 1 houses
for ($x = 1; $x <= 12; $x++) {
  for ($y = 0; $y <= LAST_PLANET; $y++) {
    $pl = $longitude2[$y] + (1 / 36000);
    if ($x < 12 and $longitude1[$x + LAST_PLANET] > $longitude1[$x + LAST_PLANET + 1]) {
      if (($pl >= $longitude1[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude1[$x + LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos2_in_1[$y] = $x;
        continue;
      }
    }

    if ($x == 12 and ($longitude1[$x + LAST_PLANET] > $longitude1[LAST_PLANET + 1])) {
      if (($pl >= $longitude1[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude1[LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos2_in_1[$y] = $x;
      }
      continue;
    }

    if (($pl >= $longitude1[$x + LAST_PLANET]) and ($pl < $longitude1[$x + LAST_PLANET + 1]) and ($x < 12)) {
      $house_pos2_in_1[$y] = $x;
      continue;
    }

    if (($pl >= $longitude1[$x + LAST_PLANET]) and ($pl < $longitude1[LAST_PLANET + 1]) and ($x == 12)) {
      $house_pos2_in_1[$y] = $x;
    }
  }
}


//get house positions of planets here - person 1 planets in person 2 houses
for ($x = 1; $x <= 12; $x++) {
  for ($y = 0; $y <= LAST_PLANET; $y++) {
    $pl = $longitude1[$y] + (1 / 36000);
    if ($x < 12 and $longitude2[$x + LAST_PLANET] > $longitude2[$x + LAST_PLANET + 1]) {
      if (($pl >= $longitude2[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude2[$x + LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos1_in_2[$y] = $x;
        continue;
      }
    }

    if ($x == 12 and ($longitude2[$x + LAST_PLANET] > $longitude2[LAST_PLANET + 1])) {
      if (($pl >= $longitude2[$x + LAST_PLANET] and $pl < 360) or ($pl < $longitude2[LAST_PLANET + 1] and $pl >= 0)) {
        $house_pos1_in_2[$y] = $x;
      }
      continue;
    }

    if (($pl >= $longitude2[$x + LAST_PLANET]) and ($pl < $longitude2[$x + LAST_PLANET + 1]) and ($x < 12)) {
      $house_pos1_in_2[$y] = $x;
      continue;
    }

    if (($pl >= $longitude2[$x + LAST_PLANET]) and ($pl < $longitude2[LAST_PLANET + 1]) and ($x == 12)) {
      $house_pos1_in_2[$y] = $x;
    }
  }
}


//display natal data
$secs = "0";
if ($timezone1 < 0) {
  $tz1 = $timezone1;
} else {
  $tz1 = "+" . $timezone1;
}

if ($timezone2 < 0) {
  $tz2 = $timezone2;
} else {
  $tz2 = "+" . $timezone2;
}

$name_without_slashes = stripslashes($name1);

$name2_without_slashes = stripslashes($name2);

// $line1 = $name_without_slashes . ", born " . strftime("%A, %B %d, %Y at %H:%M (time zone = GMT $tz1 hours)", mktime($hour1, $minute1, $secs, $month1, $day1, $year1));
// $line1 = $line1 . " at " . $long_deg1 . $ew1_txt . sprintf("%02d", $long_min1) . " and " . $lat_deg1 . $ns1_txt . sprintf("%02d", $lat_min1);

// $line2 = $name2_without_slashes . ", born " . strftime("%A, %B %d, %Y at %H:%M (time zone = GMT $tz2 hours)", mktime($hour2, $minute2, $secs, $month2, $day2, $year2));
// $line2 = $line2 . " at " . $long_deg2 . $ew2_txt . sprintf("%02d", $long_min2) . " and " . $lat_deg2 . $ns2_txt . sprintf("%02d", $lat_min2);
?>
<?php
// echo "</center>";
$hr_ob1 = $hour1;
$min_ob1 = $minute1;

$ubt1 = 0;
if (($hr_ob1 == 12) and ($min_ob1 == 0)) {
  $ubt1 = 1;
}        // this person has an unknown birth time

$hr_ob2 = $hour2;
$min_ob2 = $minute2;

$ubt2 = 0;
if (($hr_ob2 == 12) and ($min_ob2 == 0)) {
  $ubt2 = 1;
}        // this person has an unknown birth time

$rx1 = "";
for ($i = 0; $i <= SE_TNODE; $i++) {
  if ($speed1[$i] < 0) {
    $rx1 .= "R";
  } else {
    $rx1 .= " ";
  }
}

$rx2 = "";
for ($i = 0; $i <= SE_TNODE; $i++) {
  if ($speed2[$i] < 0) {
    $rx2 .= "R";
  } else {
    $rx2 .= " ";
  }
}

// to make GET string shorter (for IE6)
for ($i = 0; $i <= LAST_PLANET; $i++) {
  $L1[$i] = $longitude1[$i];
  $L2[$i] = $longitude2[$i];
}

for ($i = 1; $i <= LAST_PLANET; $i++) {
  $hc1[$i] = $longitude1[LAST_PLANET + $i];
  $hc2[$i] = $longitude2[LAST_PLANET + $i];
}



// no need to urlencode unless perhaps magic quotes is ON (??)
$ser_L1 = serialize($L1);
$ser_hc1 = serialize($hc1);
$ser_L2 = serialize($L2);
$ser_hc2 = serialize($hc2);


$_SESSION['hc1'] = $hc1;
$_SESSION['house_pos1'] = $house_pos1;
$_SESSION['hc2'] = $hc2;
$_SESSION['house_pos2_in_1'] = $house_pos2_in_1;


$wheel_width = 800;
$wheel_height = $wheel_width + 50;    //includes space at top of wheel for header




$day_sun =  Convert_Longitude($longitude2[0]);
$day_moon =  Convert_Longitude($longitude2[1]);
$day_sun = explode(' ', $day_sun)[1];
$day_moon = explode(' ', $day_moon)[1];





// display synastry data - house cusps
// if ($ubt1 == 0 or $ubt2 == 0) {
//   echo '<tr>';
//   echo "<td><font color='#0000ff'><b> Name </b></font></td>";
//   echo "<td><font color='#0000ff'><b> トランジット</b></font></td>";
//   echo "<td> &nbsp </td>";
//   echo "<td><font color='#0000ff'><b> ネイタル</b></font></td>";
//   echo "<td> &nbsp </td>";
//   echo '</tr>';

//   //ハウスの詳細情報
//   for ($i = 1; $i <= 12; $i++) {
//     echo '<tr>';
//     if ($i == 1) {
//       echo "<td>Ascendant</td>";
//     } elseif ($i == 10) {
//       echo "<td>MC (Midheaven) </td>";
//     } else {
//       echo "<td>House " . ($i) . "</td>";
//     }
//     if ($ubt1 == 1) {
//       echo "<td><font face='Courier New'>" . "&nbsp;</font></td>";
//     } else {
//       echo "<td><font face='Courier New'>" . Convert_Longitude($hc1[$i]) . "</font></td>";
//     }
//     echo "<td> &nbsp </td>";

//     if ($ubt2 == 1) {
//       echo "<td><font face='Courier New'>" . "&nbsp;</font></td>";
//     } else {
//       echo "<td><font face='Courier New'>" . Convert_Longitude($hc2[$i]) . "</font></td>";
//     }
//     echo "<td> &nbsp </td>";
//     echo '</tr>';
//   }
// }

// echo '</table></center>';
// echo "<br><br>";
// display synastry data - aspect table
$asp_name[1] = "0";
$asp_name[2] = "180";
$asp_name[3] = "60";
$asp_name[4] = "90";
$asp_name[5] = "150";
$asp_name[6] = "120";
//display the synastry chart report
if ($no_interps == False) {
  //require ('calc_dual_dyne_harmony.php');
  $longitude1[10] = $hc1[1];
  $longitude2[10] = $hc2[1];
  //$dynes = Get_Dual_Cosmodyne_Harmony($longitude1, $declination1, $house_pos1, $longitude2, $declination2, $house_pos2, $hob, $mob);
  //require ('dual_c_calcs.php');
  //require ('dual_c_mrs.php');

  $declination1[10] = $declination1[LAST_PLANET + 1];
  $declination2[10] = $declination2[LAST_PLANET + 1];

  //$xx_num_MRs = GetMutualReceptions($longitude1, $longitude2);
  //$xx_dynes = GetCosmodynes($longitude1, $declination1, $house_pos1, $longitude2, $declination2, $house_pos2, $hob, $mob);


  //echo "<center>";

  //echo '<table width="61.8%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center"><hr>';

  //echo "<font size='2'><b>The dual cosmodyne TOTAL score between " . $name1 . " and " . $name2 . " is </b></font>";
  //if ($xx_dynes[1] + ($xx_num_MRs * 5) >= 9.8)
  //{
  //echo "<font size='+1' color='#009000'>" . sprintf("%.2f", ($xx_dynes[1] + ($xx_num_MRs * 5))) . "</font>";
  //}
  //elseif ($xx_dynes[1] + ($xx_num_MRs * 5) < 0)
  //{
  //echo "<font size='+1' color='#ff0000'>" . sprintf("%.2f", ($xx_dynes[1] + ($xx_num_MRs * 5))) . "</font>";
  //}
  //else
  //{
  //echo "<font size='+1' color='#000000'>" . sprintf("%.2f", ($xx_dynes[1] + ($xx_num_MRs * 5))) . "</font>";
  //}

  //echo "<br><br><font size='2'><b>Negative scores (in red) show discord between two people, which is undesired.<br><br>An average HARMONY score is about +10.</b></font><br>";

  //echo "<hr></td></tr></table></center><br><br>";

  //with better line breaks
  // $line1 = $name_without_slashes . ", born " . strftime("%A, %B %d, %Y at %H:%M", mktime($hour1, $minute1, $secs, $month1, $day1, $year1));
  // $line1 = $line1 . "<br>(time zone = GMT $tz1 hours) at " . $long_deg1 . $ew1_txt . sprintf("%02d", $long_min1) . " and " . $lat_deg1 . $ns1_txt . sprintf("%02d", $lat_min1);

  // $line2 = $name2_without_slashes . ", born " . strftime("%A, %B %d, %Y at %H:%M", mktime($hour2, $minute2, $secs, $month2, $day2, $year2));
  // $line2 = $line2 . "<br>(time zone = GMT $tz2 hours) at " . $long_deg2 . $ew2_txt . sprintf("%02d", $long_min2) . " and " . $lat_deg2 . $ns2_txt . sprintf("%02d", $lat_min2);

  //include ('synastry_report.php');
  //Generate_synastry_report($name1, $name2, $line1, $line2, $pl_name, $longitude1, $longitude2, $hc1[1], $hc2[1], $ubt1, $ubt2, $dynes);
}


//アスペクト表に表示する天体と許容角度を調整する
for ($i = 0; $i <= SE_VENUS; $i++) {
  for ($j = SE_JUPITER; $j <= SE_PLUTO; $j++) {
    $q = 0;
    $da = Abs($longitude1[$i] - $longitude2[$j]);

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
      // } 
      // elseif (($da <= (150 + $orb)) and ($da >= (150 - $orb))) {
      //   $q = 5;
      //   $dax = $da - 150;
    } elseif ($da >= (180 - $orb)) {
      $q = 2;
      $dax = 180 - $da;
    }

    if ($q > 0) {
      $final_dax = sprintf("%.2f", abs($dax));
      $str[] = $pl_name[$i] . "-" . $asp_name[$q] . "-" . $pl_name[$j] . "-" . $final_dax;
    }
  }
}

//パターン精査のための材料を抽出
foreach ($str as $input) {
  $parts = explode('-', $input);
  // 角度を取り除く
  array_pop($parts);
  $result = implode('-', $parts);
  $parts_aspects[] = $result;
}


// include('header_synastry.html');       //here because of cookies

$name1 = stripslashes($_COOKIE['name']);

$month1 = $_COOKIE['month'];
$day1 = $_COOKIE['day'];
$year1 = $_COOKIE['year'];

$hour1 = $_COOKIE['hour'];
$minute1 = $_COOKIE['minute'];

$timezone1 = $_COOKIE['timezone'];

$long_deg1 = $_COOKIE["long_deg"];
$long_min1 = $_COOKIE["long_min"];
$ew1 = $_COOKIE["ew"];

$lat_deg1 = $_COOKIE["lat_deg"];
$lat_min1 = $_COOKIE["lat_min"];
$ns1 = $_COOKIE["ns"];

$name2 = stripslashes($_COOKIE['name2']);

$month2 = $_COOKIE['month2'];
$day2 = $_COOKIE['day2'];
$year2 = $_COOKIE['year2'];

$hour2 = $_COOKIE['hour2'];
$minute2 = $_COOKIE['minute2'];

$timezone2 = $_COOKIE['timezone2'];

$long_deg2 = $_COOKIE["long_deg2"];
$long_min2 = $_COOKIE["long_min2"];
$ew2 = $_COOKIE["ew2"];

$lat_deg2 = $_COOKIE["lat_deg2"];
$lat_min2 = $_COOKIE["lat_min2"];
$ns2 = $_COOKIE["ns2"];
?>
<?php
function Convert_Longitude($longitude)
{
  $signs = array(0 => 'おひつじ', 'おうし', 'ふたご', 'かに', 'しし', 'おとめ', 'てんびん', 'さそり', 'いて', 'やぎ', 'みずがめ', 'うお');

  $sign_num = floor($longitude / 30);
  $pos_in_sign = $longitude - ($sign_num * 30);
  $deg = floor($pos_in_sign);
  $full_min = ($pos_in_sign - $deg) * 60;
  $min = floor($full_min);
  $full_sec = round(($full_min - $min) * 60);

  if ($deg < 10) {
    $deg = "0" . $deg;
  }

  if ($min < 10) {
    $min = "0" . $min;
  }

  if ($full_sec < 10) {
    $full_sec = "0" . $full_sec;
  }

  return $deg . " " . $signs[$sign_num] . " " . $min . "' " . $full_sec . chr(34);
}


function mid($midstring, $midstart, $midlength)
{
  return (substr($midstring, $midstart - 1, $midlength));
}


function safeEscapeString($inp)
{
  if (is_array($inp))
    return array_map(__METHOD__, $inp);

  $temp1 = str_replace("<", "[", $inp);
  $temp2 = str_replace(">", "]", $temp1);

  $temp1 = str_replace("[br]", "<br />", $temp2);
  $temp2 = str_replace("[br /]", "<br />", $temp1);

  if (!empty($temp2) && is_string($temp2)) {
    return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $temp2);
  }

  return $temp2;
}


$wheel_img_src = "<img border='0' src='synastry/synastry_wheel.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&ubt1=$ubt1&ubt2=$ubt2&l1=$line1&l2=$line2' width='$wheel_width' height='$wheel_height'>";
$grid_img_src = "<img border='0' src='synastry/synastry_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='830' height='475'>";


?>