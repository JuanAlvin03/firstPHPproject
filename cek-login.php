<?php

include_once __DIR__."/library.php";

if(isset($_POST["btnSubmit"]) && isset($_POST["username"]) && isset($_POST["password"])){
    // ----------- REGISTER -------------------------------------------------------
    if($_POST["btnSubmit"] == "register"){
        if(cekUserExist($_POST["username"]) === 1 && ($_POST["username"] != "" && $_POST["username"] != null)){
            $status = MU_AddData($_POST["username"], $_POST["password"]);
            if($status === 1){
                header("location:buy-event.php");
            }
        } else {
            header("location:login.php");
        }
    // ---------------------- LOGIN ----------------------------------------------------
    } else if ($_POST["btnSubmit"] == "login"){
        $cekUser = cekLogin($_POST["username"], $_POST["password"]);
        if($cekUser !== 0){
            $_SESSION["user"] = cekLogin($_POST["username"], $_POST["password"]);
            if($cekUser->role === "ADMIN"){
                header("location:event-list.php");
            } else {
                header("location:buy-event.php");
            }
            
        } else {
            header("location:login.php");
        }
        
    } else {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
?>