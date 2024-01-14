<?php

include_once __DIR__."/library.php";
LoginCekRedirect();

if(!isset($_SESSION["event"])){
    header("location:event-list.php");
    exit;
} else if($_SESSION["event"] == "" || $_SESSION["event"] == null){
    header("location:event-list.php");
    exit;
}

$ev = getEventDetail($_SESSION["event"]);

if(isset($_POST["jenis"]) && isset($_POST["harga"]) && isset($_POST["kapasitas"])){
    if($_POST["jenis"] != "" && $_POST["harga"] != "" && $_POST["kapasitas"] != "") {
        $success = MTE_AddTicket($ev->id, $_POST["jenis"], $_POST["harga"], $_POST["kapasitas"]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Event</title>
</head>
<link rel="stylesheet" href="css/insert-event-style.css"> 
<body>
    <div class="add-event-page">
        <div class="form">
            <form class="add-event-form" method="POST">
                <span><b>Add Ticket</b></span><br><br>
                <table>
                    <tr>
                        <td>Event Name</td>
                        <td><input type="text" name="nama" disabled="true" value="<?= $ev->name ?>"></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>
                            <select name="jenis">
                                <option value="J01">VVIP</option>
                                <option value="J02">VIP</option>
                                <option value="J03">Premium</option>
                                <option value="J04">Reguler</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="text" name="harga"/></td>
                    </tr>
                    <tr>
                        <td>Capacity</td>
                        <td><input type="text" name="kapasitas"/></td>
                    </tr>
                </table>
                <br>
                <button type="submit"><b>add ticket</b></button>
            </form>
            <br>
            <form class="add-event-form" method="POST" action="event-list.php">
                <button><b>cancel</b></button>
            </form>
        </div>
    </div>
</body>
</html>