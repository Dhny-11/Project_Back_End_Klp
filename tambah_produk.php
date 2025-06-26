<?php
require "Konek.php";

$success = "";
$error = "";

// Ambil data supplier
$suppliers = [];
$qry = mysqli_query($con, "SELECT Id_Supplier, Nama_Supplier FROM supplier");
while ($row = mysqli_fetch_assoc($qry)) {
    $suppliers[] = $row;
}

// Ambil data size
$sizes = [];
$qry2 = mysqli_query($con, "SELECT Id_Size, Size FROM size");
while ($row2 = mysqli_fetch_assoc($qry2)) {
    $sizes[] = $row2;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_produk'] ?? '');
    $harga = (int)($_POST['harga'] ?? 0);
    $id_supplier = (int)($_POST['id_supplier'] ?? 0);
    $id_size = (int)($_POST['id_size'] ?? 0);

    if ($nama === '' || $harga <= 0 || $id_supplier == 0 || $id_size == 0) {
        $error = "Semua field wajib diisi!";
    } else {
        $stmt = $con->prepare("INSERT INTO Produk (Nama_Produk, Harga, Id_Supplier, Id_Size) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama, $harga, $id_supplier, $id_size);
        // Setelah berhasil insert ke produk
        if ($stmt->execute()) {
            $id_produk_baru = $stmt->insert_id;
            // Tambahkan ke inventaris
            $kuantitas = (int)($_POST['kuantitas'] ?? 0);
            $tanggal_masuk = date('Y-m-d');
            $stmt2 = $con->prepare("INSERT INTO inventaris (Id_Produk, Kuantitas_Produk, Tanggal_Masuk) VALUES (?, ?, ?)");
            $stmt2->bind_param("iis", $id_produk_baru, $kuantitas, $tanggal_masuk);
            $stmt2->execute();
            $success = "Produk berhasil ditambahkan!";
        } else {
            $error = "Gagal menambah produk: " . $con->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 32px 28px;
        }
        h3 {
            margin-bottom: 24px;
            color: #0d6efd;
            font-weight: 700;
            text-align: center;
        }
        form label {
            font-weight: 500;
            margin-top: 12px;
        }
        form input[type="text"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 4px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 12px;
        }
        button[type="submit"] {
            background: #198754;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 8px;
            transition: background 0.2s;
        }
        button[type="submit"]:hover {
            background: #157347;
        }
        a.back-link {
            display: inline-block;
            margin-top: 18px;
            color: #0d6efd;
            text-decoration: none;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
        .success, .error {
            padding: 10px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-weight: 500;
            text-align: center;
        }
        .success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        .error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Tambah Produk Baru</h3>
        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" required>
            
            <label>Harga:</label>
            <input type="number" name="harga" min="1" required>
            
            <label>Supplier:</label>
            <select name="id_supplier" required>
                <option value="">-- Pilih Supplier --</option>
                <?php foreach ($suppliers as $sup): ?>
                    <option value="<?= $sup['Id_Supplier'] ?>"><?= htmlspecialchars($sup['Nama_Supplier']) ?></option>
                <?php endforeach; ?>
            </select>
            
            <label>Size Produk:</label>
            <select name="id_size" required>
                <option value="">-- Pilih Size --</option>
                <?php foreach ($sizes as $sz): ?>
                    <option value="<?= $sz['Id_Size'] ?>"><?= htmlspecialchars($sz['Size']) ?></option>
                <?php endforeach; ?>
            </select>
            
            <label>Jumlah Stok:</label>
            <input type="number" name="kuantitas" min="1" required>
            
            <button type="submit">Tambah</button>
        </form>
        <a href="Stock.php" class="back-link">Kembali ke Stock</a>
    </div>
</body>
</html>