<?php

include_once __DIR__."/library.php";
LoginCekRedirect();

// ---------------------- Checking All Input ------------------------------------------------------------------------

if(!isset($_POST["nama"]) || !isset($_POST["tanggal"]) || !isset($_POST["lokasi"]) || !isset($_POST["gueststar"])){
    header("location:insert-event.php");
    exit;
}

if($_POST["nama"] == "" || $_POST["tanggal"] == "" || $_POST["lokasi"] == "" || $_POST["gueststar"] == ""){
    header("location:insert-event.php");
    exit;
}

$ukuran_file = $_FILES["poster"]["size"];

if($ukuran_file === 0){
    header("location:insert-event.php");
    exit;
}

// -----------------------------------------------------------------------------------------------------------------

$error_upload = false;

$id = getNewEventID();

$sumber = $_FILES["poster"]["tmp_name"];
$dir_tujuan = "posters/";
$nama_asli = $_FILES["poster"]["name"];
$imageFileType = pathinfo($nama_asli,PATHINFO_EXTENSION);
$path_tujuan = $dir_tujuan . $id . "." . $imageFileType;

if($imageFileType != "png"){
    $error_upload = true;
}
if($ukuran_file > 10000000){
    $error_upload = true;
}

$user = $_SESSION["user"]->id;
$tgl = str_replace('T', ' ', $_POST["tanggal"]) . ":00";

if(!$error_upload){
    $success = ME_AddEvent($id, $_POST["nama"], $tgl, $_POST["lokasi"], $_POST["gueststar"], $user);
    if($success){
        move_uploaded_file($sumber, $path_tujuan);
        $_SESSION["event"] = $id;
        header("location:insert-tipe-event.php");
        exit;
    } else {
        header("location:insert-event.php");
        exit;
    }
} else {
    header("location:insert-event.php");
    exit;
}

?>