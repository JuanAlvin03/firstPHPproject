<?php

include_once __DIR__."/library.php";
LoginCekRedirect();

if(isset($_POST["jenis"]) && isset($_POST["jumlah"]) && isset($_POST["eventid"])){
    if($_POST["jenis"] != "" && $_POST["jumlah"] != "" && $_POST["eventid"] != "" && is_numeric($_POST["jumlah"])){
        if(getEventDetail($_POST["eventid"]) !== 0){
            $ev = getEventDetail($_POST["eventid"]);
        }
        if(MJ_GetJenisByID($_POST["jenis"]) !== 0){
            $jen = MJ_GetJenisByID($_POST["jenis"]);
        }
    }
    else {
        header("location:buy-event.php");
        exit;
    }
} else {
    header("location:buy-event.php");
    exit;
}

$ticket = MTE_GetTicketByID($ev->id,$jen->id);

if($_POST["jumlah"] > $ticket->tersedia){ // kalau membeli lebih dari stock yang ada
    header("location:buy-event.php");
}


$total = ($ticket->harga) * $_POST["jumlah"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase</title>
</head>
<!-- CSS -->
<link rel="stylesheet" href="css/confirm-pur-style.css"> 
<body>
<div class="confirm-pur-page">
    <div class="form">  
        <form class="purchase-ticket-form" method="POST" action="doPurchase.php">
            <span><b>Purchase Ticket</b></span><br><br>
            <table>
                <tr>
                    <td>Nama Event</td>
                    <td><input type="text" name="namaevent" disabled="true" value="<?= $ev->name ?>"></td>
                </tr>
                <tr>
                    <td>Jenis Ticket</td>
                    <td><input type="text" name="jenisticket" disabled="true" value="<?= $jen->jenis ?>"></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><input type="text" name="disjumlah" disabled="true" value="<?= $_POST["jumlah"] ?>"></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><input type="text" name="distotal" disabled="true" value="<?= $total ?>"></td>
                </tr>
            </table>
            <input type="hidden" name="eventid" value="<?= $ev->id ?>">
            <input type="hidden" name="jenisid" value="<?= $jen->id ?>">
            <input type="hidden" name="jumlah" value="<?= $_POST["jumlah"] ?>">
            <input type="hidden" name="total" value="<?= $total ?>">
            <br>
            <button type="submit" name="btnConfirm"><b>Confirm</b></button>
        </form><br>
        <form class="purchase-ticket-form" method="POST" action="buy-event.php">
            <button type="submit"><b>Cancel</b></button>
        </form>
    </div>
</div>
</body>
</html>