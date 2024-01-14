<?php

include_once __DIR__."/library.php";

LoginCekRedirect();
$msg="";
$data = MPur_GetPurchasePerUser($_SESSION["user"]->id);
if($data === 0){
    $data = [];
    $msg = "You Never Purchase Anything!";
}

$_SESSION["event"] = "";
$_SESSION["event"] = null;
unset($_SESSION["event"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/event-detail-style.css"> 
</head>
<body>
    <div class="event-detail-page">
        <div class="event-detail-info">
            <div class="event-detail-nav">
                <form action="buy-event.php">
                    <button type="submit" class="btn btn-warning">Back</button>
                </form><br>
                <form action="logout.php">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            <span><b>Purchase History</b></span><br>
            <div class="jenis-ticket">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Purchase Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d) : ?>
                        <tr>
                            <td><?= $d->pid ?></td>
                            <td><?= getEventDetail($d->eid)->name ?></td>
                            <td><?= MJ_GetJenisByID($d->jid)->jenis ?></td>
                            <td><?= $d->qty ?></td>
                            <td>&#82;&#112;<?= number_format($d->total,2,",",".")?></td>
                            <td><?= $d->datetime ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $msg ?>
            </div>
        </div>
    </div>
</body>
</html>