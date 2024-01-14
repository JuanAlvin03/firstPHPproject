<?php
include_once __DIR__."/library.php";
LoginCekRedirect();

if(isset($_POST["btnDetail"])){
    if(getEventDetail($_POST["btnDetail"]) !== 0){
        $ev = getEventDetail($_POST["btnDetail"]);
    }
} else {
    header("location:event-list.php");
    exit;
}

$dataJenis = MTE_GetDataPerEvent($ev->id);
$AssocArrJenis = MJ_GetJenis_AssocArr();
//var_dump($AssocArrJenis);
$_SESSION["event"] = $ev->id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/event-detail-style.css"> 
</head>
<body>
    <div class="event-detail-page">
        <div class="event-detail-info">
            <div class="event-detail-nav">
                <form action="event-list.php">
                    <button type="submit" class="btn btn-warning">Back</button>
                </form>
                <form action="logout.php">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            <div class="detail-top-part">
                <div class="event-detail-info-left">
                    <img src="posters/<?= $ev->id ?>.png" alt="img">
                </div>

                <div class="event-detail-info-right">
                    <h1><?= $ev->name ?></h1>
                    <h4>Date & Time: <?= $ev->tanggal ?></h4>
                    <h4>Location: <?= $ev->lokasi ?></h4>
                    <h4>Guest Star: <?= $ev->gueststar ?></h4>
                    <h4>Created By: <?= $ev->createdBy ?></h4>
                </div>
            </div>
            <div class="jenis-ticket">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dataJenis as $d) : ?>
                        <tr>
                            <td><?= $AssocArrJenis[$d->jenisID] ?></td>
                            <td><?= $d->harga ?></td>
                            <td><?= $d->kapasitas ?></td>
                            <td><?= $d->tersedia ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <form action="insert-tipe-event.php" method="POST">
                <button type="submit" name="btnEvent">Add Ticket</button>
            </form>
        </div>
    </div>
</body>
</html>

