<?php

$id_supplier = $_POST['Id_Supplier'];
$nama_supplier = $_POST['Nama_Supplier'];
$nomor_telepon = $_POST['Nomor_Telepon'];
$email_perusahaan = $_POST['Email_Perusahaan'];


require "OOP.php";
$supp = new Supplier();

$data = ['Id_Supplier' => $id_supplier, 'Nama_Supplier' => $nama_supplier, 'Nomor_Telepon' => $nomor_telepon, 'Email_Perusahaan' => $email_perusahaan];

$update = $supp->updateSupplierData($data);

if ($update) {
    echo "<script>alert('Data updated successfully!');window.location='Suplier.php';</script>";
} else {
    echo "<script>alert('Failed to update data!');window.location='Suplier.php';</script>";
}
?>