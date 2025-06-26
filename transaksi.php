<?php
require "konek.php";
require "classes/Pelanggan.php";
require "classes/Produk.php";
require "classes/Karyawan.php";
require "classes/MetodePembayaran.php";
require "classes/Transaksi.php";
require "classes/Size.php";

$pelanggan = new Pelanggan($con);
$produk = new Produk($con);
$karyawan = new Karyawan($con);
$metode = new MetodePembayaran($con);
$transaksi = new Transaksi($con);
$size = new Size($con);

$errors = [];
$messages = [];
$page = $_GET['page'] ?? 'transaksi';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'transaksi') {
        $type = $_POST['tipe_pelanggan'] ?? '';
        if ($type === 'member' || $type === 'customer') {
            header("Location: ?page=$type");
            exit;
        } else {
            $errors[] = "Pilih tipe pelanggan!";
        }
    } elseif ($page === 'member') {
        $tanggal = trim($_POST['tanggal_transaksi'] ?? '');
        $member_id = (int)($_POST['member_id'] ?? 0);
        $payment_id = (int)($_POST['payment_id'] ?? 0);
        $employee_id = (int)($_POST['employee_id'] ?? 0);

        $product_ids = $_POST['product_id'] ?? [];
        $size_ids = $_POST['size_id'] ?? [];
        $qtys = $_POST['jumlah_produk'] ?? [];

        if ($tanggal === '') $errors[] = "Tanggal wajib diisi.";
        if ($member_id == 0) $errors[] = "Pilih Member.";
        if ($payment_id == 0) $errors[] = "Pilih Metode Pembayaran.";
        if ($employee_id == 0) $errors[] = "Pilih Karyawan.";

        if (empty($product_ids) || empty($qtys)) {
            $errors[] = "Minimal satu produk harus dipilih.";
        } else {
            foreach ($product_ids as $i => $pid) {
                if ((int)$pid == 0) $errors[] = "Pilih produk ke-" . ($i+1);
                if ((int)$qtys[$i] <= 0) $errors[] = "Jumlah produk ke-" . ($i+1) . " harus lebih dari 0.";
            }
        }

        if (!$errors) {
            // 1. Insert ke tabel Transaksi
            $stmt = $con->prepare("INSERT INTO Transaksi (Tanggal_Transaksi, Id_Customer, Id_MetodePembayaran, Id_Karyawan) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $tanggal, $member_id, $payment_id, $employee_id);
            $stmt->execute();
            $id_transaksi = $con->insert_id;

            // 2. Insert ke tabel Transaksi_Detail untuk setiap produk
            foreach ($product_ids as $i => $pid) {
                $qty = (int)$qtys[$i];
                $size_id = (int)($size_ids[$i] ?? 0);

                // Validasi size_id
                if ($size_id <= 0) {
                    $errors[] = "Pilih ukuran untuk produk ke-" . ($i+1);
                    continue;
                }

                $harga = $produk->getHarga($pid);
                if (!$harga) {
                    $errors[] = "Produk ke-" . ($i+1) . " tidak ditemukan.";
                    continue;
                }
                $harga_satuan = $harga['Harga'];
                $subtotal = $harga_satuan * $qty;
                $stmt2 = $con->prepare("INSERT INTO Transaksi_Detail (Id_Transaksi, Id_Produk, Id_Size, Jumlah_Produk, Harga_Satuan, Subtotal) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt2->bind_param("iiiidd", $id_transaksi, $pid, $size_id, $qty, $harga_satuan, $subtotal);
                $stmt2->execute();
            }
            if (empty($errors)) {
                $messages[] = "Transaksi berhasil ditambahkan.";
            }
        }
    } elseif ($page === 'customer') {
        $tanggal = trim($_POST['tanggal_transaksi'] ?? '');
        $nama_customer = trim($_POST['nama_customer'] ?? '');
        $no_telp = trim($_POST['no_telp'] ?? '');
        $payment_id = (int)($_POST['payment_id'] ?? 0);
        $employee_id = (int)($_POST['employee_id'] ?? 0);

        $product_ids = $_POST['product_id'] ?? [];
        $size_ids = $_POST['size_id'] ?? [];
        $qtys = $_POST['jumlah_produk'] ?? [];

        if ($tanggal === '') $errors[] = "Tanggal wajib diisi.";
        if ($nama_customer === '') $errors[] = "Nama customer wajib diisi.";
        if ($no_telp === '') $errors[] = "No telepon wajib diisi.";
        if ($payment_id == 0) $errors[] = "Pilih Metode Pembayaran.";
        if ($employee_id == 0) $errors[] = "Pilih Karyawan.";

        if (empty($product_ids) || empty($qtys)) {
            $errors[] = "Minimal satu produk harus dipilih.";
        } else {
            foreach ($product_ids as $i => $pid) {
                if ((int)$pid == 0) $errors[] = "Pilih produk ke-" . ($i+1);
                if ((int)$qtys[$i] <= 0) $errors[] = "Jumlah produk ke-" . ($i+1) . " harus lebih dari 0.";
            }
        }

        if (!$errors) {
            // 1. Insert ke tabel Transaksi (tanpa insert ke tabel pelanggan/member)
            $stmt = $con->prepare("INSERT INTO Transaksi (Tanggal_Transaksi, Nama_Customer, No_Telp, Id_MetodePembayaran, Id_Karyawan) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $tanggal, $nama_customer, $no_telp, $payment_id, $employee_id);
            $stmt->execute();
            $id_transaksi = $con->insert_id;

            // 2. Insert ke tabel Transaksi_Detail untuk setiap produk
            foreach ($product_ids as $i => $pid) {
                $qty = (int)$qtys[$i];
                $size_id = (int)($size_ids[$i] ?? 0);

                // Validasi size_id
                if ($size_id <= 0) {
                    $errors[] = "Pilih ukuran untuk produk ke-" . ($i+1);
                    continue;
                }

                $harga = $produk->getHarga($pid);
                if (!$harga) {
                    $errors[] = "Produk ke-" . ($i+1) . " tidak ditemukan.";
                    continue;
                }
                $harga_satuan = $harga['Harga'];
                $subtotal = $harga_satuan * $qty;
                $stmt2 = $con->prepare("INSERT INTO Transaksi_Detail (Id_Transaksi, Id_Produk, Id_Size, Jumlah_Produk, Harga_Satuan, Subtotal) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt2->bind_param("iiiidd", $id_transaksi, $pid, $size_id, $qty, $harga_satuan, $subtotal);
                $stmt2->execute();
            }
            if (empty($errors)) {
                $messages[] = "Transaksi berhasil ditambahkan.";
            }
        }
    }

    if (empty($errors)) {
        header("Location: struk.php?id=$id_transaksi");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi</title>
    <link rel="stylesheet" href="transaksi.css">
</head>
<body>
<div class="container">
    <?php
    // Tampilkan pesan error/sukses
    if (!empty($errors)) {
        echo '<div class="errors">';
        foreach ($errors as $err) echo '<div>' . htmlspecialchars($err) . '</div>';
        echo '</div>';
    }
    if (!empty($messages)) {
        echo '<div class="messages">';
        foreach ($messages as $msg) echo '<div>' . htmlspecialchars($msg) . '</div>';
        echo '</div>';
    }

    // Tampilkan form sesuai page
    if ($page === 'member') {
        $members = $pelanggan->getMembers();
        $products = $produk->getAll();
        $payments = $metode->getAll();
        $employees = $karyawan->getAll();
        include "views/form_member.php";
    } elseif ($page === 'customer') {
        $products = $produk->getAll();
        $payments = $metode->getAll();
        $employees = $karyawan->getAll();
        include "views/form_customer.php";
    } else {
        include "views/form_transaksi.php";
    }
    ?>
</div>
</body>
</html>