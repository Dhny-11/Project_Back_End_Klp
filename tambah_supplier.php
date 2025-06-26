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
    <title>Tambah Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Supplier</h2>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="mb-4">
            <div class="mb-2">
                <label>Nama Supplier:</label>
                <input type="text" name="nama_supplier" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Supplier</button>
        </form>
        <a href="Suplier.php" class="btn btn-secondary">Lihat Daftar Supplier</a>
    </div>
</body>
</html>