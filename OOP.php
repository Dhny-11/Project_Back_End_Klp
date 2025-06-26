<?php
require_once "KonekOOP.php";

class Supplier extends KonekOOP {
    public function __construct() {
        parent::__construct();
    }

    public function getAllSupplier() {
        $qry = mysqli_query($this->con, "SELECT supplier.*, produk.Nama_Produk 
            FROM supplier 
            LEFT JOIN produk ON supplier.Id_Supplier = produk.Id_Supplier");
        $data = [];
        while ($datas = mysqli_fetch_assoc($qry)) {
            $data[] = $datas;
        }
        return $data;
    }

    public function getSupplierById($id_supplier) {
        $qry = mysqli_query($this->con, "SELECT * FROM supplier WHERE Id_Supplier = '$id_supplier'");
        return mysqli_fetch_assoc($qry);
    }

    public function addSupplier($nama, $telp, $email) {
        $qry = mysqli_query($this->con, "INSERT INTO supplier (Nama_Supplier, Nomor_Telepon, Email_Perusahaan) VALUES ('$nama', '$telp', '$email')");
        if ($qry) {
            return mysqli_insert_id($this->con); 
        }
        return false;
    }

    public function addProduk($nama_produk, $id_supplier, $harga, $id_size) {
        $qry = mysqli_query($this->con, "INSERT INTO produk (Nama_Produk, Id_Supplier, Harga, Id_Size) VALUES ('$nama_produk', '$id_supplier', '$harga', '$id_size')");
        if (!$qry) {
            die("Query error: " . mysqli_error($this->con));
        }
        return $qry;
    }

    public function updateSupplierData($data){
        $Id_supplier = $data['Id_Supplier'];
        $Nama_supplier = $data['Nama_Supplier'];
        $Nomor_telepon = $data['Nomor_Telepon'];
        $Email_perusahaan = $data['Email_Perusahaan'];
        $qry = mysqli_query($this->con, "UPDATE supplier SET 
            Nama_Supplier = '$Nama_supplier', 
            Nomor_Telepon = '$Nomor_telepon', 
            Email_Perusahaan = '$Email_perusahaan' 
            WHERE Id_Supplier = '$Id_supplier'");
        return $qry;
    }
}

class Stock extends KonekOOP {
    public function __construct() {
        parent::__construct();
    }

    public function getAllProduk() {
        $qry = mysqli_query($this->con, "SELECT i.Id_Inventaris, i.Id_Produk, p.Nama_Produk, p.Harga, i.Kuantitas_Produk, i.Tanggal_Masuk  
            FROM inventaris as i 
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
        $qry1 = mysqli_query($this->con, "UPDATE inventaris SET 
            Kuantitas_Produk = '$kuantitas_produk', 
            Tanggal_Masuk = '$tanggal_masuk' 
            WHERE Id_Inventaris = '$id_inventaris'");
        $qry2 = mysqli_query($this->con, "UPDATE produk SET 
            Harga = '$harga' 
            WHERE Id_Produk = '$id_produk'");
        return $qry1 && $qry2;
    }
}






