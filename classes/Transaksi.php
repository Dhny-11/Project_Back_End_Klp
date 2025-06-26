<?php
class Transaksi {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function tambah($data) {
        $stmt = $this->con->prepare("INSERT INTO Transaksi (Tanggal_Transaksi, Id_Customer, Id_Produk, Id_MetodePembayaran, Jumlah_Produk, Id_Karyawan, Harga_Total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiiid", $data['tanggal'], $data['customer_id'], $data['product_id'], $data['payment_id'], $data['qty'], $data['employee_id'], $data['total']);
        return $stmt->execute();
    }
}