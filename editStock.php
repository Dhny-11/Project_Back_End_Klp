<?php 
require "OOP.php";
$STK = new Stock();

$id_inventaris = isset($_GET['Id_Inventaris']) ? $_GET['Id_Inventaris'] : null;
$data = $STK->getStockById($id_inventaris);
// var_dump($id_inventaris, $data); // Hapus jika sudah tidak perlu
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Stock</title>
    <link href="Style.css" rel="stylesheet">
</head>
<body>
    <header class = " bg-primary text-white text-center py-5   header" style="justify-content: center;">
        <h1>Edit Stock</h1>
    </header>
    <div class="container">
        <div class="content">
            <h2>Edit Stock</h2>
            <?php if ($data): ?>
            <form method="POST" action="EditStockPros.php">
            <input type="hidden" name="Id_Inventaris" value="<?= $id_inventaris ?>">
            <input type="hidden" name="Id_Produk" value="<?= $data['Id_Produk'] ?>">
            <label style="font-size: 1.5rem;">Nama Produk: <?= $data['Nama_Produk'] ?></label><br>
            <label>Harga:</label>
            <input type="number" class="form-control" name="Harga" value="<?= $data['Harga'] ?>" required><br>
            <label>Kuantitas:</label>
            <input type="number" class="form-control" name="Kuantitas_Produk" value="<?= $data['Kuantitas_Produk'] ?>" required><br>
            <label>Tanggal Masuk:</label>
            <input type="date" class="form-control" name="Tanggal_Masuk" value="<?= $data['Tanggal_Masuk'] ?>" required><br>
            <button type="submit" name="update">Update</button>
                </form>
            <?php else: ?>
                <p>Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>