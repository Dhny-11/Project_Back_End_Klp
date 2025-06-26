<?php
$id_inventaris = $_POST['Id_Inventaris'];
$id_produk = $_POST['Id_Produk'];
$kuantitas = $_POST['Kuantitas_Produk'];
$harga = $_POST['Harga'];
$tanggal = $_POST['Tanggal_Masuk'];

require "OOP.php";
$stock = new Stock();
$update = $stock->updateStockData($id_inventaris, $id_produk, $kuantitas, $harga, $tanggal);

if ($update) {
    echo "<script>alert('Data updated successfully!');window.location='Stock.php';</script>";
} else {
    echo "<script>alert('Failed to update data!');window.location='Stock.php';</script>";
}
?>