<?php
$in_test = 0;                               //1 = in test mode, 0 = not in test mode

$deg_in_each_house = 30;

$max_num_pl_in_each_house = 8;

if ($max_num_pl_in_each_house == 7) {
  $spacing = 4;                             //spacing between planet glyphs around wheel - this number is really one more than shown here

  $font_size_house_cusp_sign = 28;
  $font_size_house_cusp_deg = 20;
  $font_size_house_cusp_min = 20;
  $font_size_house_numbers = 20;

  $font_size_planet_glyph = 32;
  $font_size_planet_deg = 18;
  $font_size_planet_min = 16;
  $font_size_planet_sign = 20;
  $font_size_retrograde = 20;
  $font_size_in_test_longitude = 12;
} elseif ($max_num_pl_in_each_house == 8) {
  $spacing = 3;                             //spacing between planet glyphs around wheel - this number is really one more than shown here

  $font_size_house_cusp_sign = 28;
  $font_size_house_cusp_deg = 20;
  $font_size_house_cusp_min = 20;
  $font_size_house_numbers = 20;

  $font_size_planet_glyph = 28;
  $font_size_planet_deg = 16;
  $font_size_planet_min = 14;
  $font_size_planet_sign = 18;
  $font_size_retrograde = 16;
  $font_size_in_test_longitude = 12;
}

include("constants.php");

$retrograde = safeEscapeString($_GET["rx1"]);

$longitude = unserialize($_GET["p1"]);
$hc = unserialize($_GET["hc1"]);
$house_pos = unserialize($_GET["hpos"]);

if ($in_test != 0) {
  $hc[1] = 0;                               //make flat chart with natural houses
  $hc[2] = 30;
  $hc[3] = 60;
  $hc[4] = 90;
  $hc[5] = 120;
  $hc[6] = 150;
  $hc[7] = 180;
  $hc[8] = 210;
  $hc[9] = 240;
  $hc[10] = 270;
  $hc[11] = 300;
  $hc[12] = 330;
  $hc[13] = $hc[1];
}

$Ascendant = $hc[1];
$hc[13] = $hc[1];             //without this, PhpED, v 19.515, bombs at line 386 (when doing Venus in my chart)

//set the content-type
header("Content-type: image/png");

//create the blank image
$overall_size = 640 * 2;
$im = imagecreatetruecolor($overall_size, $overall_size) or die("Cannot initialize new GD image stream");

//specify the colors
$white = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$light_blue = imagecolorallocate($im, 220, 229, 255);
$yellow = imagecolorallocate($im, 255, 255, 204);
$green = imagecolorallocate($im, 0, 224, 0);
$light_green = imagecolorallocate($im, 153, 255, 153);
$another_green = imagecolorallocate($im, 0, 128, 0);
$gray = imagecolorallocate($im, 153, 153, 153);
$light_gray = imagecolorallocate($im, 248, 248, 248);
$black = imagecolorallocate($im, 0, 0, 0);
$orange = imagecolorallocate($im, 255, 128, 64);

//specific colors
$planet_color = $black;
$deg_min_color = $black;

$size_of_rect = $overall_size;              //size of rectangle in which to draw the wheel
$diameter = 520 * 2;                        //diameter of circle drawn
$outer_outer_diameter = 600 * 2;            //diameter of circle drawn
$inner_diameter_offset = 125 * 2;           //diameter of inner circle drawn
$inner_diameter_offset_2 = 105 * 2;         //diameter of nextmost inner circle drawn
$dist_from_diameter1 = 32 * 2;              //distance inner planet glyph is from circumference of wheel
$radius = $diameter / 2;                    //radius of circle drawn
$middle_radius = (($outer_outer_diameter + $diameter) / 4) - 3;   //the radius for the middle of the two outer circles
$center_pt = $size_of_rect / 2;             //center of circle

$last_planet_num = 14;
$num_planets = $last_planet_num + 1;

//glyphs used for planets - ASTRC___.TTF - Sun, Moon - Pluto (some bodies are still HamburgSymbols.ttf, like Chiron and above)
$pl_glyph[0] = 192;       //81;             //comments are codes for HamburgSymbols.ttf font
$pl_glyph[1] = 193;       //87;
$pl_glyph[2] = 194;       //69;
$pl_glyph[3] = 195;       //82;
$pl_glyph[4] = 196;       //84;
$pl_glyph[5] = 197;       //89;
$pl_glyph[6] = 198;       //85;
$pl_glyph[7] = 199;       //73;
$pl_glyph[8] = 200;       //79;
$pl_glyph[9] = 201;       //80;
$pl_glyph[10] = 77;       //Chiron
$pl_glyph[11] = 96;       //Lilith
$pl_glyph[12] = 141;      //Node
$pl_glyph[13] = 60;       //P of F
$pl_glyph[14] = 109;      //Vertex

//glyphs used for planets - ASTRC___.TTF - Aries - Pisces
$sign_glyph[1] = 204;     //97;             //comments are codes for HamburgSymbols.ttf font
$sign_glyph[2] = 205;     //115;
$sign_glyph[3] = 206;     //100;
$sign_glyph[4] = 207;     //102;
$sign_glyph[5] = 208;     //103;
$sign_glyph[6] = 209;     //104;
$sign_glyph[7] = 210;     //106;
$sign_glyph[8] = 211;     //107;
$sign_glyph[9] = 212;     //108;
$sign_glyph[10] = 213;    //122;
$sign_glyph[11] = 214;    //120;
$sign_glyph[12] = 215;    //99;

// ------------------------------------------

//create colored rectangle on blank image
imagefilledrectangle($im, 0, 0, $size_of_rect, $size_of_rect, $white);

//MUST BE HERE - I DO NOT KNOW WHY - MAYBE TO PRIME THE PUMP
imagettftext($im, 10, 0, 0, 0, $black, dirname(__FILE__) . '/arial.ttf', " ");

//draw the outer-outer border of the chartwheel
imagefilledellipse($im, $center_pt, $center_pt, $outer_outer_diameter + 80, $outer_outer_diameter + 80, $white);

//draw the outer-outer circle of the chartwheel
imagefilledellipse($im, $center_pt, $center_pt, $outer_outer_diameter, $outer_outer_diameter, $light_blue);
imageellipse($im, $center_pt, $center_pt, $outer_outer_diameter, $outer_outer_diameter, $black);

//draw the outer circle of the chartwheel
imagefilledellipse($im, $center_pt, $center_pt, $diameter, $diameter, $white);
imageellipse($im, $center_pt, $center_pt, $diameter, $diameter, $black);

//draw the inner circle of the chartwheel
imagefilledellipse($im, $center_pt, $center_pt, $diameter - ($inner_diameter_offset_2 * 2), $diameter - ($inner_diameter_offset_2 * 2), $light_blue);
imagefilledellipse($im, $center_pt, $center_pt, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $white);
imageellipse($im, $center_pt, $center_pt, $diameter - ($inner_diameter_offset_2 * 2), $diameter - ($inner_diameter_offset_2 * 2), $black);
imageellipse($im, $center_pt, $center_pt, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $black);

// ------------------------------------------

//draw the horizontal line for the Ascendant
$x1 = - ($radius - $inner_diameter_offset) * cos(deg2rad(0));
$y1 = - ($radius - $inner_diameter_offset) * sin(deg2rad(0));

$x2 = -$radius * cos(deg2rad(0));
$y2 = -$radius * sin(deg2rad(0));

imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

//draw the arrow for the Ascendant
$x1 = -$radius;
$y1 = 30 * sin(deg2rad(0));

$x2 = - ($radius - 12);
$y2 = 12 * sin(deg2rad(-15));
imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

$y2 = 12 * sin(deg2rad(15));
imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

// ------------------------------------------

//draw the actual house cusp numbers and sign
for ($i = 1; $i <= 12; $i = $i + 1) {
  $angle = ($i - 1) * 30;                   //was $angle = -($Ascendant - $hc[$i]);

  $sign_pos = floor($hc[$i] / 30) + 1;

  if ($sign_pos == 1 or $sign_pos == 5 or $sign_pos == 9) {
    $clr_to_use = $red;
  } elseif ($sign_pos == 2 or $sign_pos == 6 or $sign_pos == 10) {
    $clr_to_use = $another_green;
  } elseif ($sign_pos == 3 or $sign_pos == 7 or $sign_pos == 11) {
    $clr_to_use = $orange;
  } elseif ($sign_pos == 4 or $sign_pos == 8 or $sign_pos == 12) {
    $clr_to_use = $blue;
  }

  display_house_cusp($i, $angle, $middle_radius, $xy);      //sign glyph
  //imagettftext($im, $font_size_house_cusp_sign, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $clr_to_use, dirname(__FILE__) . '/HamburgSymbols.ttf', chr($sign_glyph[$sign_pos]));
  imagettftext($im, $font_size_house_cusp_sign, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $clr_to_use, dirname(__FILE__) . '/ASTRC___.TTF', chr($sign_glyph[$sign_pos]));

  if ($i >= 1 and $i <= 6)                  //house cusp degree
  {
    display_house_cusp($i, $angle - 5, $middle_radius, $xy);
  } else {
    display_house_cusp($i, $angle + 5, $middle_radius, $xy);
  }

  $reduced_pos = Reduce_below_30($hc[$i]);
  $int_reduced_pos = floor($reduced_pos);

  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }

  imagettftext($im, $font_size_house_cusp_deg, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $black, dirname(__FILE__) . '/arial.ttf', $t . chr(176));    //house cusp degree

  if ($i >= 1 and $i <= 4)                  //house cusp minute
  {
    display_house_cusp($i, $angle + 5, $middle_radius, $xy);
  } elseif ($i == 5 or $i == 6) {
    display_house_cusp($i, $angle + 5, $middle_radius, $xy);
  } elseif ($i == 7) {
    display_house_cusp($i, $angle - 4, $middle_radius, $xy);
  } else {
    display_house_cusp($i, $angle - 5, $middle_radius, $xy);
  }

  $reduced_pos = Reduce_below_30($hc[$i]);
  $int_reduced_pos = floor(60 * ($reduced_pos - floor($reduced_pos)));

  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }

  imagettftext($im, $font_size_house_cusp_min, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $black, dirname(__FILE__) . '/arial.ttf', $t . chr(39));
}

// ------------------------------------------

$spoke_length = 20;                         //draw the lines for the house cusps

for ($i = 1; $i <= 12; $i = $i + 1) {
  $angle = ($i - 1) * 30;                   //was $angle = $Ascendant - $hc[$i];

  $x1 = -$radius * cos(deg2rad($angle));
  $y1 = -$radius * sin(deg2rad($angle));

  $x2 = - ($radius - $inner_diameter_offset) * cos(deg2rad($angle));
  $y2 = - ($radius - $inner_diameter_offset) * sin(deg2rad($angle));

  if ($i != 1) {
    imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $gray);
  }

  display_house_number($i, $angle, $radius - $inner_diameter_offset, $xy);    //display the house numbers themselves
  imagettftext($im, $font_size_house_numbers, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $black, dirname(__FILE__) . '/arial.ttf', $i);
}

// ------------------------------------------

//draw the near-vertical line for the MC
$angle = 90;                                //was $angle = $Ascendant - $hc[10];

$dist_mc_asc = $angle;

if ($dist_mc_asc < 0) {
  $dist_mc_asc = $dist_mc_asc + 360;
}

$value = 90 - $dist_mc_asc;
$angle1 = 65 - $value;
$angle2 = 65 + $value;

$x1 = - ($radius - $inner_diameter_offset) * cos(deg2rad($angle));
$y1 = - ($radius - $inner_diameter_offset) * sin(deg2rad($angle));

$x2 = -$radius * cos(deg2rad($angle));
$y2 = -$radius * sin(deg2rad($angle));

imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

$x1 = $x2 + (15 * cos(deg2rad($angle1)));     //draw the arrow for the 10th house cusp (MC)
$y1 = $y2 + (15 * sin(deg2rad($angle1)));
imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

$x1 = $x2 - (15 * cos(deg2rad($angle2)));
$y1 = $y2 + (15 * sin(deg2rad($angle2)));
imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $black);

// ------------------------------------------

Sort_planets_by_descending_longitude($num_planets, $longitude, $sort, $sort_pos);          //put planets in wheel - sort longitudes, descending order, 360 to 0

Count_planets_in_each_house($num_planets, $house_pos, $sort_pos, $sort, $nopih, $home);    //count how many planets are in each house

for ($i = 0; $i <= 359; $i++) {
  $spot_filled[$i] = 0;
}

$house_num = 0;

if ($in_test == 0) {
  for ($i = $num_planets - 1; $i >= 0; $i--)            //add planet glyphs around circle
  {
    //$sort() holds longitudes in descending order from 360 down to 0 - $sort_pos() holds the planet number corresponding to that longitude
    $temp = $house_num;
    $house_num = $house_pos[$sort_pos[$i]];             //get the house this planet is in

    if ($temp != $house_num) {
      $planets_done = 1;        //this planet is in a different house than the last one - i.e., this planet is the first one in this house
    }

    $from_cusp = Crunch($sort[$i] - $hc[$house_num]);   //get index for this planet as to where it should be in the possible xx different positions around the wheel

    if (($from_cusp >= 360 - 1 / 36000) and ($from_cusp <= 360 + 1 / 36000)) {
      $from_cusp = 0;
    }

    //==========================================================================

    $indexy = floor($from_cusp * $max_num_pl_in_each_house / $deg_in_each_house);

    if ($indexy >= $max_num_pl_in_each_house - $nopih[$house_num])              //adjust the index as needed based on other planets in the same house, etc.
    {
      if ($max_num_pl_in_each_house - $indexy - $nopih[$house_num] + $planets_done <= 0) {
        if ($indexy - $nopih[$house_num] + $planets_done < 0) {
          $indexy = $max_num_pl_in_each_house - $nopih[$house_num];
        } else {
          if ($spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] == 0) {
            $indexy = $max_num_pl_in_each_house - $nopih[$house_num] + $planets_done - 1;
          } else {
            $indexy = $max_num_pl_in_each_house - $nopih[$house_num];
          }
        }
      }

      if ($indexy < 0) {
        $indexy = 0;
      }
    }

    while ($spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] == 1)     //see if this spot around the wheel has already been filled
    {
      $indexy++;                //yes, so push the planet up one position
    }

    $spot_filled[(($house_num - 1) * $max_num_pl_in_each_house) + $indexy] = 1;             //mark this position as being filled

    $chart_idx = ($house_num - 1) * $max_num_pl_in_each_house + $indexy;                    //set the final index

    //take the above index and convert it into an angle
    $planet_angle[$sort_pos[$i]] = ($chart_idx * (3 * $deg_in_each_house) / (3 * $max_num_pl_in_each_house)) + ($deg_in_each_house / (2 * $max_num_pl_in_each_house));    //needed for aspect lines

    $angle_to_use = $planet_angle[$sort_pos[$i]];                               //needed for placing info on chartwheel

    //==========================================================================

    $our_angle = $angle_to_use;                                                 //in degrees

    $angle_to_use = deg2rad($angle_to_use);

    $planets_done++;            //denote that we have done at least one planet in this house (actually count the planets in this house that we have done)

    display_planet_glyph_in_test($angle_to_use, $radius - $dist_from_diameter1 + 62, $xy);

    //==========================================================================

    if ($sort_pos[$i] <= SE_PLUTO) {
      imagettftext($im, $font_size_planet_glyph, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $planet_color, dirname(__FILE__) . '/ASTRC___.TTF', chr($pl_glyph[$sort_pos[$i]]));
    } else {
      imagettftext($im, $font_size_planet_glyph, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $planet_color, dirname(__FILE__) . '/HamburgSymbols.ttf', chr($pl_glyph[$sort_pos[$i]]));
    }

    $reduced_pos = Reduce_below_30($sort[$i]);      //display degrees of longitude for each planet
    $int_reduced_pos = floor($reduced_pos);

    if ($int_reduced_pos < 10) {
      $t = "0" . $int_reduced_pos;
    } else {
      $t = $int_reduced_pos;
    }

    display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - 40, $xy, 1);
    imagettftext($im, $font_size_planet_deg, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $planet_color, dirname(__FILE__) . '/arial.ttf', $t . chr(176));

    $sign_pos = floor($sort[$i] / 30) + 1;          //display planet sign
    display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - 80, $xy, 2);

    if ($sign_pos == 1 or $sign_pos == 5 or $sign_pos == 9) {
      $clr_to_use = $red;
    } elseif ($sign_pos == 2 or $sign_pos == 6 or $sign_pos == 10) {
      $clr_to_use = $another_green;
    } elseif ($sign_pos == 3 or $sign_pos == 7 or $sign_pos == 11) {
      $clr_to_use = $orange;
    } elseif ($sign_pos == 4 or $sign_pos == 8 or $sign_pos == 12) {
      $clr_to_use = $blue;
    }

    //imagettftext($im, $font_size_planet_sign, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $clr_to_use, dirname(__FILE__) . '/HamburgSymbols.ttf', chr($sign_glyph[$sign_pos]));
    imagettftext($im, $font_size_planet_sign, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $clr_to_use, dirname(__FILE__) . '/ASTRC___.TTF', chr($sign_glyph[$sign_pos]));

    $int_reduced_pos = floor(60 * ($reduced_pos - floor($reduced_pos)));        //display minutes of longitude for each planet

    if ($int_reduced_pos < 10) {
      $t = "0" . $int_reduced_pos;
    } else {
      $t = $int_reduced_pos;
    }

    display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - 120, $xy, 1);
    imagettftext($im, $font_size_planet_min, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $planet_color, dirname(__FILE__) . '/arial.ttf', $t . chr(39));

    if (strtoupper(mid($retrograde, $sort_pos[$i] + 1, 1)) == "R")              //display Rx symbol
    {
      display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - 154, $xy, 3);
      imagettftext($im, $font_size_retrograde, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $red, dirname(__FILE__) . '/HamburgSymbols.ttf', chr(62));
    }
  }

  // ------------------------------------------

  $i = $i;                                          //for setting a breakpoint, if needed during debug

  for ($i = 0; $i <= $last_planet_num - 1; $i++)    //draw the aspect lines
  {
    for ($j = $i + 1; $j <= $last_planet_num; $j++) {
      $q = 0;

      $da = abs($longitude[$sort_pos[$i]] - $longitude[$sort_pos[$j]]);

      if ($da > 180) {
        $da = 360 - $da;
      }

      //set orb - 8 if Sun or Moon, 6 if not Sun or Moon
      $orb = 6;
      if ($sort_pos[$i] == SE_SUN or $sort_pos[$i] == SE_MOON or $sort_pos[$j] == SE_SUN or $sort_pos[$j] == SE_MOON) {
        $orb = 8;
      }

      if ($da <= $orb)                              //is there an aspect within orb?
      {
        $q = 1;
      } elseif (($da <= (60 + $orb)) and ($da >= (60 - $orb))) {
        $q = 6;
      } elseif (($da <= (90 + $orb)) and ($da >= (90 - $orb))) {
        $q = 4;
      } elseif (($da <= (120 + $orb)) and ($da >= (120 - $orb))) {
        $q = 3;
      } elseif (($da <= (150 + $orb)) and ($da >= (150 - $orb))) {
        $q = 5;
      } elseif ($da >= (180 - $orb)) {
        $q = 2;
      }

      if ($q > 0) {
        if ($q == 1 or $q == 3 or $q == 6) {
          $aspect_color = $green;
        } elseif ($q == 4 or $q == 2) {
          $aspect_color = $red;
        } elseif ($q == 5) {
          $aspect_color = $blue;
        }

        if ($q != 1 and $sort_pos[$i] != SE_VERTEX and $sort_pos[$j] != SE_VERTEX and $sort_pos[$i] != SE_LILITH and $sort_pos[$j] != SE_LILITH and $sort_pos[$i] != SE_POF and $sort_pos[$j] != SE_POF) {
          $x1 = (-$radius + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$i]]));       //non-conjunctions
          $y1 = ($radius - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$i]]));
          $x2 = (-$radius + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$j]]));
          $y2 = ($radius - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$j]]));

          imageline($im, $x1 + $center_pt, $y1 + $center_pt, $x2 + $center_pt, $y2 + $center_pt, $aspect_color);
        }
      }
    }
  }
} else {
  //in test mode ($in_test) - add planet glyphs around circle
  $step = $deg_in_each_house / $max_num_pl_in_each_house;

  $cnt = 0;
  $last_long = 0;
  $idx = 0;

  for ($i = 0; $i <= 359.99; $i = $i + $step) {
    $angle_to_use = deg2rad($i + ($step / 2));

    display_planet_glyph_in_test($angle_to_use, $radius, $xy);

    //$glyph = rand(0, 9);
    $glyph = $cnt;

    imagettftext($im, $font_size_planet_glyph, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $planet_color, dirname(__FILE__) . '/ASTRC___.TTF', chr($pl_glyph[$glyph]));

    repeat_me:
    $long = rand(0, 29) + (rand(1, 9) / 10);      //display degrees of longitude for each planet
    $long = sprintf("%03.1f", $long);

    if ($long < $idx * $step or $long > ($idx + 1) * $step) {
      goto repeat_me;
    } else {
      $last_long = $long;
    }

    if (mid($retrograde, $i + 1, 1) == "R") {
      $t = $long . mid($retrograde, $i + 1, 1);
    } else {
      $t = $long;
    }

    display_planet_longitude($angle_to_use, $radius - 64, $xy);

    imagettftext($im, $font_size_in_test_longitude, 0, $xy[0] + $center_pt, $xy[1] + $center_pt, $deg_min_color, dirname(__FILE__) . '/arial.ttf', $t);

    $cnt++;
    if ($glyph > 8) {
      $cnt = 0;
    }

    $idx++;
    if ($idx > $max_num_pl_in_each_house - 1) {
      $idx = 0;

      $last_long = 0;
    }
  }
}

// ------------------------------------------

//draw the image in png format - using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
exit();


// ------------------------------------------


function mid($midstring, $midstart, $midlength)
{
  return (substr($midstring, $midstart - 1, $midlength));
}


function Crunch($x)
{
  if ($x >= 0) {
    $y = $x - floor($x / 360) * 360;
  } else {
    $y = 360 + ($x - ((1 + floor($x / 360)) * 360));
  }

  return $y;
}


function Reduce_below_30($longitude)
{
  $lng = $longitude;

  while ($lng >= 30) {
    $lng = $lng - 30;
  }

  return $lng;
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


function Sort_planets_by_descending_longitude($num_planets, $longitude, &$sort, &$sort_pos)
{
  for ($i = 0; $i <= $num_planets - 1; $i++)        //load all $longitude() into sort() and keep track of the planet numbers in $sort_pos()
  {
    $sort[$i] = $longitude[$i];
    $sort_pos[$i] = $i;
  }

  for ($i = 0; $i <= $num_planets - 2; $i++)        //do the actual sort
  {
    for ($j = $i + 1; $j <= $num_planets - 1; $j++) {
      if ($sort[$j] > $sort[$i]) {
        $temp = $sort[$i];
        $temp1 = $sort_pos[$i];

        $sort[$i] = $sort[$j];
        $sort_pos[$i] = $sort_pos[$j];

        $sort[$j] = $temp;
        $sort_pos[$j] = $temp1;
      }
    }
  }
}


function Count_planets_in_each_house($num_planets, $house_pos, &$sort_pos, &$sort, &$nopih, &$home)
{
  for ($i = 1; $i <= 12; $i++)                          //reset and count the number of planets in each house
  {
    $nopih[$i] = 0;
  }

  for ($i = 0; $i <= $num_planets - 1; $i++)            //run through all the planets and see how many planets are in each house
  {
    //get house planet is in
    $temp = $house_pos[$sort_pos[$i]];
    $nopih[$temp]++;
    $home[$i] = $temp;
  }

  while ($home[$num_planets - 1] == $home[0])           //now check for Aries planets in same house as Pisces planets that do not start a new house
  {
    $temp1 = $sort[$num_planets - 1];
    $temp2 = $sort_pos[$num_planets - 1];
    $temp3 = $home[$num_planets - 1];

    for ($i = $num_planets - 1; $i >= 1; $i--) {
      $sort[$i] = $sort[$i - 1];
      $sort_pos[$i] = $sort_pos[$i - 1];
      $home[$i] = $home[$i - 1];
    }

    $sort[0] = $temp1;
    $sort_pos[0] = $temp2;
    $home[0] = $temp3;
  }
}


function display_house_number($num, $angle, $radii, &$xy)
{
  $char_width = 30;
  if ($num < 10) {
    $char_width = 20;
  }

  $half_char_width = $char_width / 2;

  $char_height = 24;
  $half_char_height = $char_height / 2;

  if ($num == 1) {
    $xpos0 = -14;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 24;
    $y_adj = sin(deg2rad($angle)) * $char_height;
  } elseif ($num == 2) {
    $xpos0 = -18;
    $x_adj = -cos(deg2rad($angle));
    $ypos0 = 13;
    $y_adj = sin(deg2rad($angle)) * $char_height;
  } elseif ($num == 3) {
    $xpos0 = 2;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 24;
    $y_adj = sin(deg2rad($angle)) * $half_char_height;
  } elseif ($num == 4) {
    $xpos0 = 8;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 16;
    $y_adj = sin(deg2rad($angle)) * $half_char_height;
  } elseif ($num == 5) {
    $xpos0 = 17;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 1;
    $y_adj = sin(deg2rad($angle)) * $half_char_height;
  } elseif ($num == 6) {
    $xpos0 = 17;
    $x_adj = -cos(deg2rad($angle));
    $ypos0 = -16;
    $y_adj = sin(deg2rad($angle)) * $char_height;
  } elseif ($num == 7) {
    $xpos0 = -10;
    $x_adj = -cos(deg2rad($angle)) * $char_width;
    $ypos0 = -12;
    $y_adj = -sin(deg2rad($angle)) * $char_height;
  } elseif ($num == 8) {
    $xpos0 = -12;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = -12;
    $y_adj = sin(deg2rad($angle));
  } elseif ($num == 9) {
    $xpos0 = -28;
    $x_adj = -cos(deg2rad($angle)) * $char_width;
    $ypos0 = -11;
    $y_adj = sin(deg2rad($angle));
  } elseif ($num == 10) {
    $xpos0 = -30;
    $x_adj = -cos(deg2rad($angle)) * $char_width;
    $ypos0 = 6;
    $y_adj = sin(deg2rad($angle)) * $half_char_height;
  } elseif ($num == 11) {
    $xpos0 = -28;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 24;
    $y_adj = sin(deg2rad($angle)) * $char_height;
  } elseif ($num == 12) {
    $xpos0 = -22;
    $x_adj = -cos(deg2rad($angle)) * $half_char_width;
    $ypos0 = 20;
    $y_adj = sin(deg2rad($angle)) * $char_height;
  }

  $xy[0] = $xpos0 + $x_adj - ($radii * cos(deg2rad($angle + 12)));
  $xy[1] = $ypos0 + $y_adj + ($radii * sin(deg2rad($angle + 12)));;

  return ($xy);
}


function display_planet_glyph($our_angle, $angle_to_use, $radii, &$xy, $code)
{
  //$code = 0 for planet glyph, 1 for text, 2 for sign glyph, 3 for Rx symbol
  //$our_angle in degree, $angle_to_use in radians
  $this_angle = Crunch($our_angle);

  if ($this_angle >= 1 and $this_angle <= 181) {
    if ($code == 0) {
      $cw_pl_glyph = 17 * 2;
      $ch_pl_glyph = 17 * 2;
    } elseif ($code == 1) {
      $cw_pl_glyph = 14 * 2;
      $ch_pl_glyph = 12 * 2;
    } elseif ($code == 2) {
      $cw_pl_glyph = 14 * 2;
      $ch_pl_glyph = 12 * 2;
    } else {
      $cw_pl_glyph = 8 * 2;
      $ch_pl_glyph = 10 * 2;
    }
  } else {
    if ($code == 0) {
      $cw_pl_glyph = 19 * 2;
      $ch_pl_glyph = 17 * 2;
    } elseif ($code == 1) {
      $cw_pl_glyph = 15 * 2;
      $ch_pl_glyph = 8 * 2;
    } elseif ($code == 2) {
      $cw_pl_glyph = 15 * 2;
      $ch_pl_glyph = 8 * 2;
    } else {
      $cw_pl_glyph = 6 * 2;
      $ch_pl_glyph = 10 * 2;
    }
  }

  $gap_pl_glyph = -10 * 2;

  //take into account the width and height of the glyph, defined below
  //get distance we need to shift the glyph so that the absolute middle of the glyph is the start point
  $center_pos_x = -$cw_pl_glyph / 2;
  $center_pos_y = $ch_pl_glyph / 2;

  //get the offset we have to move the center point to in order to be properly placed
  $offset_pos_x = $center_pos_x * cos($angle_to_use);
  $offset_pos_y = $center_pos_y * sin($angle_to_use);

  //now get the final X, Y coordinates
  $xy[0] = $center_pos_x + $offset_pos_x + ((-$radii + $gap_pl_glyph) * cos($angle_to_use));
  $xy[1] = $center_pos_y + $offset_pos_y + (($radii - $gap_pl_glyph) * sin($angle_to_use));

  return ($xy);
}


function display_house_cusp($num, $angle, $radii, &$xy)
{
  $char_width = 18 * 2;
  $half_char_width = $char_width / 2;
  $char_height = 12 * 2;
  $half_char_height = $char_height / 2;

  //puts center of character right on circumference of circle
  $xpos0 = -$half_char_width;
  $ypos0 = $half_char_height;

  $x_adj = -cos(deg2rad($angle));
  $y_adj = sin(deg2rad($angle));

  $xy[0] = $xpos0 + $x_adj - ($radii * cos(deg2rad($angle)));
  $xy[1] = $ypos0 + $y_adj + ($radii * sin(deg2rad($angle)));;

  return ($xy);
}


function display_planet_longitude($angle_to_use, $radii, &$xy)
{
  $cw_deg_min = 18;
  $ch_deg_min = 10;
  $gap_deg_min = 15;

  //take into account the width and height of the deg/min, defined below
  //get distance we need to shift the deg/min so that the absolute middle of the deg/min is the start point
  $center_pos_x = -$cw_deg_min / 2;
  $center_pos_y = $ch_deg_min / 2;

  //get the offset we have to move the center point to in order to be properly placed
  $offset_pos_x = $center_pos_x * cos($angle_to_use);
  $offset_pos_y = $center_pos_y * sin($angle_to_use);

  //now get the final X, Y coordinates
  $xy[0] = $center_pos_x + $offset_pos_x + ((-$radii + $gap_deg_min) * cos($angle_to_use));
  $xy[1] = $center_pos_y + $offset_pos_y + (($radii - $gap_deg_min) * sin($angle_to_use));

  return ($xy);
}


function display_planet_glyph_in_test($angle_to_use, $radii, &$xy)
{
  if ($angle_to_use >= 0 and $angle_to_use < 90) {
    $cw_pl_glyph = 30;          //houses 10 to 12
    $ch_pl_glyph = 32;
  } elseif ($angle_to_use >= 90 and $angle_to_use < 180) {
    $cw_pl_glyph = 19;          //houses 7 to 9
    $ch_pl_glyph = 17;
  } elseif ($angle_to_use >= 180 and $angle_to_use < 270) {
    $cw_pl_glyph = 19;          //houses 4 to 6
    $ch_pl_glyph = 17;
  } else {
    $cw_pl_glyph = 30;          //houses 1 to 3
    $ch_pl_glyph = 17;
  }

  $gap_pl_glyph = 40;      //was 40;

  //take into account the width and height of the glyph, defined below
  //get distance we need to shift the glyph so that the absolute middle of the glyph is the start point
  $center_pos_x = -$cw_pl_glyph / 2;
  $center_pos_y = $ch_pl_glyph / 2;

  //get the offset we have to move the center point to in order to be properly placed
  $offset_pos_x = $center_pos_x * cos($angle_to_use);
  $offset_pos_y = $center_pos_y * sin($angle_to_use);

  //now get the final X, Y coordinates
  $xy[0] = $center_pos_x + $offset_pos_x + ((-$radii + $gap_pl_glyph) * cos($angle_to_use));
  $xy[1] = $center_pos_y + $offset_pos_y + (($radii - $gap_pl_glyph) * sin($angle_to_use));

  return ($xy);
}
