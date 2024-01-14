<?php

include_once __DIR__."/library.php";

LoginCekRedirect();

/** @var \PDO $db */
global $db;
$data = [];

$query = "SELECT * FROM event";
$temp = $db->query($query);
foreach ($temp as $k => $d) {
    $data[] = new Event($d["id"], $d["name"], $d["tanggal"], $d["lokasi"], $d["gueststar"], $d["createdby"]);
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
    <title>Event List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/event-list-style.css"> 
</head>
<body>
    <div class="event-list-page">
        <div class="event-list-table">

            <div class="event-list-nav">
                <h2>Welcome, <?= $_SESSION["user"]->username ?></h2>
                <form action="logout.php">
                    <div class="align-right">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </div>
                </form>
                <form action="historyPurchase.php">
                    <button type="submit" class="btn btn-primary">Purchase History</button>
                </form>
            </div>

            <div class="event-list-table-title">
                <h1 style="text-align: center;">EVENT LIST</h1>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Guest Star</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data as $d) : ?>
                <tr>
                    <td><?= $d->id ?></td>
                    <td><?= $d->name ?></td>
                    <td><?= $d->tanggal ?></td>
                    <td><?= $d->lokasi ?></td>
                    <td><?= $d->gueststar ?></td>
                    <td>
                        <form action="buy-ticket.php" method="POST">
                            <button type="submit" value="<?= $d->id ?>" name="btnDetail" class="btn btn-success">
                                Purchase
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>