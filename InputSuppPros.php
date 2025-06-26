<?php

require "OOP.php";
$supp = new Supplier();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_supplier = $_POST['Nama_Supplier'];
    $nomor_telepon = $_POST['Nomor_Telepon'];
    $is_size = $_POST['Id_Size'];
    $email = $_POST['Email_Perusahaan'];
    $nama_produk = $_POST['Nama_Produk'];
    $harga = $_POST['Harga'];

    // Validasi Id_Size
    if (empty($id_size) || !is_numeric($id_size)) {
    echo "<script>alert('Silakan pilih Size Produk yang valid!');window.location='InputSupp.php';</script>";
    exit;
}

    // Tambah supplier
    $id_supplier = $supp->addSupplier($nama_supplier, $nomor_telepon, $email);

    if ($id_supplier) {
    $supp->addProduk($nama_produk, $id_supplier, $harga, $id_size);
    echo "<script>alert('Supplier & Produk berhasil ditambahkan!');window.location='Suplier.php';</script>";
}else {
        echo "<script>alert('Gagal menambah supplier!');window.location='InputSupp.php';</script>";
    }
} else {
    header("Location: InputSupp.php");
    exit;
}
