<?php

include_once __DIR__."/dto.php";
include_once __DIR__."/conn.php";
session_start();

function LoginCekRedirect() : void {
    if(session_id() == ""){
        session_start();
    }
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
        exit;
    }
}

function MU_GetData() : array {
    /** @var \PDO $db */
    global $db;
    $data = [];
    
    $query = "SELECT * FROM user";
    $temp = $db->query($query);
    foreach ($temp as $k => $d) {
        $data[] = new User($d["userID"], $d["username"], $d["password"], $d["role"]);
    }

    return $data;
}

function MU_AddData($user, $pass) : int {
    /** @var \PDO $db */
    global $db;

    $success = 0;
    $role = "MEMBER";

    $query = "SELECT * FROM user";
    $temp = $db->query($query);
    $maks = 0;
    foreach ($temp as $k => $d) {
        $number = substr($d["userID"],1,4);
        $number = (int) $number;
        if($number > $maks){
            $maks = $number;
        }
    }
    $maks++;
    $newID = "U";
    $maks = str_pad($maks,4,'0',STR_PAD_LEFT);
    $newID = $newID . $maks;

    $query = "INSERT INTO user VALUES(:id, :user, :password, :role)";
    $stmt = $db->prepare($query);
    $success = $stmt->execute([
        "id" => $newID,
        "user" => $user,
        "password" => password_hash($pass, PASSWORD_DEFAULT),
        "role" => $role
    ]);
    return $success;
}

function cekLogin($user, $pass){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM user WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "username" => $user
    ]);

    $data = $stmt->fetchAll();
    // username is unique, so either it returns zero result or only one
    if($data == []){
        return $status;
    } else {
        foreach ($data as $k => $d) {
            if(password_verify($pass, $d["password"])){
                $status = new User($d["userID"], $d["username"], $d["password"], $d["role"]);
                return $status;
            }
        }
    }
    return $status;   
}

function cekUserExist($user){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM user WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "username" => $user
    ]);

    $data = $stmt->fetchAll();
    // username is unique, so either it returns zero result or only one
    if($data == []){
        $status = 1;
    } else {
        $status = 0;
    }
    return $status;   
}

function getEventDetail($id){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM event WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "id" => $id
    ]);

    $data = $stmt->fetchAll();
    // id is unique, so either it returns zero result or only one
    if($data == []){
        $status = 0;
    } else {
        foreach ($data as $k => $d) {
            $status = new Event($d["id"], $d["name"], $d["tanggal"], $d["lokasi"], $d["gueststar"], $d["createdby"]);
        }
    }
    return $status;  
}

function getNewEventID(){
    /** @var \PDO $db */
    global $db;

    $query = "SELECT * FROM event";
    $temp = $db->query($query);
    $maks = 0;
    foreach ($temp as $k => $d) {
        $number = substr($d["id"],1,4);
        $number = (int) $number;
        if($number > $maks){
            $maks = $number;
        }
    }
    $maks++;
    $newID = "E";
    $maks = str_pad($maks,4,'0',STR_PAD_LEFT);
    $newID = $newID . $maks;

    return $newID;
}

function ME_AddEvent($id, $name, $tanggal, $lokasi, $gueststar, $createdBy){
    /** @var \PDO $db */
    global $db;

    $success = 0;

    $query = "INSERT INTO event VALUES(:id, :name, :tanggal, :lokasi, :gueststar, :createdBy)";
    $stmt = $db->prepare($query);
    $success = $stmt->execute([
        "id" => $id,
        "name" => $name,
        "tanggal" => $tanggal,
        "lokasi" => $lokasi,
        "gueststar" => $gueststar,
        "createdBy" => $createdBy
    ]);
    return $success;
}

function MTE_GetDataPerEvent($eventID){
    /** @var \PDO $db */
    global $db;
    $data = [];
    
    $query = "SELECT * FROM ticket where eventID = :id";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "id" => $eventID
    ]);
    $temp = $stmt->fetchAll();
    foreach ($temp as $k => $d) {
        $data[] = new Ticket($d["eventID"], $d["jenisID"], $d["kapasitas"], $d["harga"], $d["tersedia"]);
    }

    return $data;
}

function MJ_GetJenis_AssocArr(){
    /** @var \PDO $db */
    global $db;
    $data = [];
    
    $query = "SELECT * FROM jenis";
    $temp = $db->query($query);
    foreach ($temp as $k => $d) {
        $data[$d["id"]] = $d["name"];  
    }

    return $data;
}

function MTE_AddTicket($eventid,$jenisid,$harga,$kapasitas){
    /** @var \PDO $db */
    global $db;

    $success = 0;

    $query = "INSERT INTO ticket VALUES(:eventid, :jenisid, :harga, :kapasitas, :tersedia)";
    $stmt = $db->prepare($query);
    $success = $stmt->execute([
        "eventid" => $eventid,
        "jenisid" => $jenisid,
        "harga" => $harga,
        "kapasitas" => $kapasitas,
        "tersedia" => $kapasitas
    ]);
    return $success;
}

function MJ_GetJenisByID($id){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM jenis WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "id" => $id
    ]);

    $data = $stmt->fetchAll();
    // id is unique, so either it returns zero result or only one
    if($data == []){
        $status = 0;
    } else {
        foreach ($data as $k => $d) {
            $status = new Jenis($d["id"], $d["name"]);
        }
    }
    return $status;
}

function MTE_GetTicketByID($eventid,$jenisid){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM ticket WHERE eventID = :eventid AND jenisID = :jenisid";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "eventid" => $eventid,
        "jenisid" => $jenisid
    ]);

    $data = $stmt->fetchAll();
    // id is unique, so either it returns zero result or only one
    if($data == []){
        $status = 0;
    } else {
        foreach ($data as $k => $d) {
            $status = new Ticket($d["eventID"], $d["jenisID"], $d["kapasitas"], $d["harga"], $d["tersedia"]);
        }
    }
    return $status;
}

function MPur_AddPurchase($eventid,$jenisid,$userid,$qty,$total){
    /** @var \PDO $db */
    global $db;

    $success = 0;

    $query = "SELECT * FROM purchase";
    $temp = $db->query($query);
    $maks = 0;
    foreach ($temp as $k => $d) {
        $number = substr($d["purchaseid"],1,4);
        $number = (int) $number;
        if($number > $maks){
            $maks = $number;
        }
    }
    $maks++;
    $newID = "P";
    $maks = str_pad($maks,4,'0',STR_PAD_LEFT);
    $newID = $newID . $maks;

    $query = "INSERT INTO purchase VALUES(:purid, :eid, :jid, :uid, :qty, :total, now())";
    $stmt = $db->prepare($query);
    $success = $stmt->execute([
        "purid" => $newID,
        "eid" => $eventid,
        "jid" => $jenisid,
        "uid" => $userid,
        "qty" => $qty,
        "total" => $total
    ]);

    $ticket = MTE_GetTicketByID($eventid,$jenisid);
    $sisa = $ticket->tersedia - $qty;

    $status = 0;
    $query = "UPDATE ticket SET tersedia = :sisa WHERE eventid = :eid AND jenisid = :jid";
    $stmt = $db->prepare($query);

    $status = $stmt->execute([ 
        "sisa" => $sisa,
        "eid" => $eventid,
        "jid" => $jenisid,
    ]);

    return $success;
}

function MPur_GetPurchasePerUser($userid){
    /** @var \PDO $db */
    global $db;
    $data = [];

    $status = 0;
    $query = "SELECT * FROM purchase WHERE userid = :uid";
    $stmt = $db->prepare($query);
    $stmt->execute([
        "uid" => $userid
    ]);

    $data = $stmt->fetchAll();

    if($data == []){
        $status = 0;
    } else {
        $status = array();
        foreach ($data as $k => $d) {
            $status[] = new Purchase($d["purchaseid"], $d["eventid"], $d["jenisid"], $d["userid"], $d["qty"], $d["total"], $d["purchasedatetime"]);
        }
    }
    return $status;
}

?>