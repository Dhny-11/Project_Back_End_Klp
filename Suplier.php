<?php
require "Konek.php";
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_supplier'] ?? '');
    $telp = trim($_POST['nomor_telepon'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nama === '' || $telp === '' || $email === '') {
        $error = "Semua field wajib diisi!";
    } else {
        $stmt = $con->prepare("INSERT INTO supplier (Nama_Supplier, Nomor_Telepon, Email_Perusahaan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $telp, $email);
        if ($stmt->execute()) {
            $success = "Supplier berhasil ditambahkan!";
        } else {
            $error = "Gagal menambah supplier: " . $con->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        header > nav > a{
            color: black;
            text-decoration: none;
            margin-left: 10px;
        }
        header>nav > a:hover {
            color: white;
            text-decoration: underline;
        }
        header > nav {
            justify-content: space-between;    
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-5 header">
        <h1>Supplier Manajemen</h1>
        <p class="lead">Selamat Datang Di Sistem Manajemen Suplier</p>
        <nav class="d-flex justify-content-center">
            <a href="">Home</a>
            <a href="Stock.php">Produk</a>
        </nav>
    </header>
    <div class="container">
            <h2>Supplier List</h2>
            <a href="tambah_supplier.php" class="btn btn-success mb-3">+ Tambah Supplier</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $qry = mysqli_query($con, "SELECT Id_Supplier, Nama_Supplier, Nomor_Telepon, Email_Perusahaan FROM supplier");
                while ($s = mysqli_fetch_assoc($qry)) {
                ?>
                    <tr>
                        <td><?= $s['Id_Supplier'] ?></td>
                        <td><?= htmlspecialchars($s['Nama_Supplier']) ?></td>
                        <td><?= htmlspecialchars($s['Nomor_Telepon']) ?></td>
                        <td><?= htmlspecialchars($s['Email_Perusahaan']) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>