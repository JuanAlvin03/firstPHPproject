<?php

include_once __DIR__."/library.php";
LoginCekRedirect();

if($_SESSION["user"]->role !== "ADMIN"){
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
    <title>Create Event</title>
</head>
<link rel="stylesheet" href="css/insert-event-style.css"> 
<body>
    <div class="add-event-page">
        <div class="form">
            <form class="add-event-form" method="POST" action="doInsertEvent.php" enctype="multipart/form-data">
                <span><b>New Event</b></span><br><br>
                <table>
                    <tr>
                        <td>Event Name</td>
                        <td><input type="text" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><input type="datetime-local" name="tanggal"></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><input type="text" name="lokasi"/></td>
                    </tr>
                    <tr>
                        <td>Guest Star</td>
                        <td><input type="text" name="gueststar"/></td>
                    </tr>
                    <tr>
                        <td>Poster</td>
                        <td><input type="file" name="poster"></td>
                    </tr>
                </table>
                <br>
                <button type="submit"><b>add event</b></button>
            </form>
            <br>
            <form class="add-event-form" method="POST" action="event-list.php">
                <button><b>cancel</b></button>
            </form>
        </div>
    </div>
</body>
</html>