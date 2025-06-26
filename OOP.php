<?php
require "KonekOOP.php";
class Stock extends KonekOOP {
    public function __construct() {
    parent::__construct();
    }

    public function getAllProduk() {
        $qry = mysqli_query($this->con, "SELECT i.Id_Inventaris, i.Id_Produk, p.Nama_Produk, p.Harga, i.Kuantitas_Produk, i.Tanggal_Masuk  FROM inventaris as i 
        JOIN produk as p ON i.Id_Produk = p.Id_Produk");
        $data = [];
        while ($datas = mysqli_fetch_assoc($qry)) {
            $data[] = $datas;
        }   
        return $data;
    }
    public function getStockById($id_inventaris) {
    $qry = mysqli_query($this->con, "SELECT i.Id_Inventaris, i.Id_Produk, p.Nama_Produk, p.Harga, i.Kuantitas_Produk, i.Tanggal_Masuk  
        FROM inventaris as i 
        JOIN produk as p ON i.Id_Produk = p.Id_Produk 
        WHERE i.Id_Inventaris = '$id_inventaris'");
    return mysqli_fetch_assoc($qry); 
}

    public function updateStockData($id_inventaris, $id_produk, $kuantitas_produk, $harga, $tanggal_masuk) {
    // Update inventaris
    $qry1 = mysqli_query($this->con, "UPDATE inventaris SET 
        Kuantitas_Produk = '$kuantitas_produk', 
        Tanggal_Masuk = '$tanggal_masuk' 
        WHERE Id_Inventaris = '$id_inventaris'");
    // Update harga produk
    $qry2 = mysqli_query($this->con, "UPDATE produk SET 
        Harga = '$harga' 
        WHERE Id_Produk = '$id_produk'");
    return $qry1 && $qry2;
}

}





