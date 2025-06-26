<?php
class MetodePembayaran {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function getAll() {
        return $this->con->query("SELECT Id_MetodePembayaran, Nama_Metode FROM Metode_Pembayaran ORDER BY Nama_Metode");
    }
}