<?php
class KonekOOP {
    protected $con;
    function __construct() {
        $this->con = mysqli_connect("localhost", "root", "", "boutique");
        if (!$this->con) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }
}
