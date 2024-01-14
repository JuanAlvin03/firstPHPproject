<?php

include_once __DIR__."/library.php";
LoginCekRedirect();

if(isset($_POST["btnDetail"])){
    if(getEventDetail($_POST["btnDetail"]) !== 0){
        $ev = getEventDetail($_POST["btnDetail"]);
    }
} else {
    header("location:buy-event.php");
    exit;
}

$dataJenis = MTE_GetDataPerEvent($ev->id);
$AssocArrJenis = MJ_GetJenis_AssocArr();
var_dump($AssocArrJenis);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/event-detail-style.css"> 
</head>
<body>
    <div class="event-detail-page">
        <div class="event-detail-info">
            <div class="event-detail-nav">
                <form action="buy-event.php">
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
                </div>
            </div>
            <div class="jenis-ticket">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket type</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dataJenis as $d) : ?>
                        <tr>
                            <td><?= $AssocArrJenis[$d->jenisID] ?></td>
                            <td>&#82;&#112;<?= number_format($d->harga,2,",",".")?></td>
                            <td><?= $d->kapasitas ?></td>
                            <td><?= $d->tersedia ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="buy-ticket-form">  
                <span><b>Purchase</b></span>          
                <form action="confirm-transaction.php" method="POST">
                    <label for="jenis">Tipe</label>
                    <select name="jenis">
                        <option value="J01">VVIP</option>
                        <option value="J02">VIP</option>
                        <option value="J03">Premium</option>
                        <option value="J04">Reguler</option>
                    </select><br>
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah"><br>
                    <input type="hidden" name="eventid" value="<?= $ev->id ?>">
                    <button type="submit" class="btn btn-primary" name="btnBuy">Buy</button>
                </form>
            </div>
        </div>
    </div>
    <!--<script src="buy-ticket-script.js"></script>-->
</body>
</html>

<!--
<div>
                    <label for="jenis">Tipe</label>
                    <select name="jenis">
                        <option value="J01">VVIP</option>
                        <option value="J02">VIP</option>
                        <option value="J03">Premium</option>
                        <option value="J04">Reguler</option>
                    </select><br>
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah"><br>
                    <button type="submit" class="btn btn-primary" name="btnAddToCart" onclick="addToCart(event)">Add To Cart</button>
                </div>
                
                <div>   
                    <button type="submit" class="btn btn-danger" name="btnClearCart" onclick="clearCart()">Clear Cart</button>
                </div>
                
                <div>
                    <span><b>Cart</b></span>
                    <table id="cart-table">
                            
                    </table>
                    <button type="submit" class="btn btn-success" name="btnBuy">Buy</button>
                </div>
                        -->

