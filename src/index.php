<?php
// var_dump($_SERVER['PATH_INFO']);
$path = explode("/", $_SERVER["PATH_INFO"]);
switch ($path[1]) {
    case "login":
        include "login.php";
        exit;
    case "register":
        include "register.php";
        exit;
    case "natal":
        include "natal.php";
        exit;
    case "profile":
        include "profile.php";
        exit;
    case "transit":
        include "transit.php";
        exit;
    case "diary":
        include "diary.php";
        exit;
    case "post_form":
        include "post_form.php";
        exit;
    case "post_view":
        include "post_view.php";
        exit;
    case "post_edit":
        include "post_edit.php";
        exit;
    case "profile_edit":
        include "profile_edit.php";
        exit;
    case "logout":
        include "logout.php";
        exit;
}
?>

<?php include './layout/header.php'; ?>

<?php include './layout/footer.php'; ?>