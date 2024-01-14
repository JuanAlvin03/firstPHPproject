<?php

    include_once __DIR__."/conn.php";
    include_once __DIR__."/library.php";

    /** @var \PDO $db *//*
    global $db;
    $user = "member2";
    $password = "member2";
    $role = "MEMBER";

    $query = "INSERT INTO user VALUES(:id, :user, :password, :role)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "id" => "U0004",
        "user" => $user,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "role" => $role
    ]);*/

    /** @var \PDO $db *//*
    global $db;
    $max = 0;

    $query = "SELECT * FROM user";
    $temp = $db->query($query);

    foreach ($temp as $k => $d) {
        $number = substr($d["userID"],1,4);
        $number = (int) $number;
        echo $number . "<br>";
    }
    $number++;
    $newID = "U";
    $number = str_pad($number,4,'0',STR_PAD_LEFT);
    $newID = $newID . $number;
    echo $newID;*/

    /*
    if(isset($_POST["tanggal"])){
        echo "ini tgl yg dipilih: " . str_replace('T', ' ', $_POST["tanggal"]) . ":00";
    }*/

    /*
    $dataJenis = MTE_GetDataPerEvent("E0001");
    $AssocArrJenis = MJ_GetJenis_AssocArr();
    var_dump($AssocArrJenis);
    */
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        tgl
        <input type="datetime-local" name="tanggal">
        <button type="submit" name="btn">Submit</button>
    </form>
</body>
</html>
-->