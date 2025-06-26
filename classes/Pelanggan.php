<?php
class Pelanggan {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function getMembers() {
        return $this->con->query("SELECT Id_Customer, Nama_Customer FROM pelanggan ORDER BY Nama_Customer");
    }
    public function addCustomer($nama, $telp) {
        $stmt = $this->con->prepare("INSERT INTO pelanggan (Nama_Customer, No_Telp) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $telp);
        $stmt->execute();
        return $this->con->insert_id;
    }
}