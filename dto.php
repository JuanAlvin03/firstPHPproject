<?php

class User{
    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($id, $username, $password, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}

class Event{
    public $id;
    public $name;
    public $tanggal;
    public $lokasi;
    public $gueststar;
    public $createdBy;

    public function __construct($id, $nama, $tanggal, $lokasi, $gueststar, $createdBy){
        $this->id = $id;
        $this->name = $nama;
        $this->tanggal = $tanggal;
        $this->lokasi = $lokasi;
        $this->gueststar = $gueststar;
        $this->createdBy = $createdBy;
    }
}

class Ticket{
    public $eventID;
    public $jenisID;
    public $kapasitas;
    public $harga;
    public $tersedia;

    public function __construct($eventID, $jenisID,$kapasitas, $harga, $tersedia){
        $this->eventID = $eventID;
        $this->jenisID = $jenisID;
        $this->kapasitas = $kapasitas;
        $this->harga = $harga;
        $this->tersedia = $tersedia;
    }
}

class Jenis{
    public $id;
    public $jenis;

    public function __construct($id, $jenis){
        $this->id = $id;
        $this->jenis = $jenis;
    }
}

class Purchase{
    public $pid;
    public $eid;
    public $jid;
    public $uid;
    public $qty;
    public $total;
    public $datetime;

    public function __construct($pid, $eid,$jid, $uid,$qty, $total,$datetime){
        $this->pid = $pid;
        $this->eid = $eid;
        $this->jid = $jid;
        $this->uid = $uid;
        $this->qty = $qty;
        $this->total = $total;
        $this->datetime = $datetime;
    }

}

?>