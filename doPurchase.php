<?php

include_once __DIR__."/library.php";
LoginCekRedirect();
$msg = "Purchase Failed!";
if(isset($_POST["btnConfirm"])){
    $Pur = MPur_AddPurchase($_POST["eventid"],$_POST["jenisid"], $_SESSION["user"]->id, $_POST["jumlah"], $_POST["total"]);
    if($Pur !== 0){
        $msg = "Purchase Success!";
    }
} else {
    header("location:buy-event.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Status</title>
    <link rel="stylesheet" href="css/login-style.css"> 
</head>
<body>
    <div class="login-page">
        <div class="form">
            <span><b><?= $msg ?></b></span><br><br>
            <form class="login-form" method="POST" action="buy-event.php">
                <button type="submit" name="btnSubmit"><b>Back To Event List</b></button>
            </form>
            <br>
            <form class="login-form" method="POST" action="historyPurchase.php">
                <button type="submit" name="btnSubmit"><b>Purchase History</b></button>
            </form>
        </div>
    </div>
</body>
</html>