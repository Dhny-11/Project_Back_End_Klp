<?php
class Produk {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function getAll() {
        return $this->con->query("SELECT Id_Produk, Nama_Produk FROM Produk ORDER BY Nama_Produk");
    }
    public function getHarga($id) {
        $stmt = $this->con->prepare("SELECT Harga FROM Produk WHERE Id_Produk = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}