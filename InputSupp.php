<?php
require "Konek.php"; // pastikan nama file dan require sama persis
$sizes = [];
$qry = mysqli_query($con, "SELECT * FROM size");
if (!$qry) {
    die("Query error: " . mysqli_error($con));
}
while ($row = mysqli_fetch_assoc($qry)) {
    $sizes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Supplier Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
        <h1>Input Supplier Baru</h1>
        <p class="lead">Silahkan Isi Formulir Berikut Untuk Menambahkan Supplier Baru</p>
        <nav class="d-flex justify-content-center">
            <a href="Suplier.php">Kembali Ke Daftar Supplier</a>
    </header>
        <div class="container">
            <div class="contetn">
                <form action="InputSuppPros.php" method="POST" class="form">
                    <div class="mb-3">
                        <label for="Nama_Supplier" class="form-label">Nama Supplier:</label>
                        <input type="text" class="form-control" id="Nama_Supplier" name="Nama_Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="Nama_Produk" class="Form-label">Nama Produk:</label>
                        <input type="text" class="form-control" id="Nama_Produk" name="Nama_Produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="Nomor_Telepon" class="form-label">Nomor Telepon:</label>
                        <input type="text" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="Email_Perusahaan" class="form-label">Email Perusahaan:</label>
                        <input type="email" class="form-control" id="Email_Perusahaan" name="Email_Perusahaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga Produk:</label>
                        <input type="number" class="form-control" id="Harga" name="Harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="Id_Size" class="form-label">Size Produk:</label>
                        <select class="form-control" id="Id_Size" name="Id_Size" required>
                            <option value="" disabled selected>Pilih Size</option>
                            <?php foreach($sizes as $sz): ?>
                                <option value="<?= $sz['Id_Size'] ?>"><?= $sz['Size'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah Supplier</button>
                    </div>
                </form>
            </div>
        </div>

</body>
</html>