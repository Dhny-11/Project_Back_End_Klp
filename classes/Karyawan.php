<?php
class Karyawan {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function getAll() {
        return $this->con->query("SELECT Id_Karyawan, Nama_Karyawan FROM Karyawan ORDER BY Nama_Karyawan");
    }
}