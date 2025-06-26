<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suplier</title>
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
    <h1>Supplier Manajemen</h1>
    <p class="lead">Selamat Datang Di Sistem Manajemen Suplier</p>
    <nav class="d-flex justify-content-center">
        <a href="">Home</a>
        <a href="Stock.php" > Produk</a>
    </nav>
    </header>
    <div class="container">
        <div class="content mt-3">
            <h2>Supplier List</h2>
            <table class="table table-striped">
                <th>ID Supplier </th>
                <th>Nama Supplier</th>
                <th>Nama Produk</th>
                <th>Nomor Tlp</th>
                <th>Email</th>
                <th>Edit</th>
            </form>

            <?php
            require "OOP.php";
            $supplier = new Supplier();
            $suppliers = $supplier->getAllSupplier();
            foreach ($suppliers as $s) {
            ?>
            <tbody>
            <tr>
                <td><?= $s['Id_Supplier'] ?></td>
                <td><?= $s['Nama_Supplier'] ?></td>
                <td><?= $s['Nama_Produk']?></td>
                <td><?= $s['Nomor_Telepon'] ?></td>
                <td><?= $s['Email_Perusahaan'] ?></td>
                <td><a href="EditSupplier.php?Id_Supplier=<?= $s['Id_Supplier']?>"><button class="btn btn-warning"> Edit</button></a></td>
            </tr>
            </tbody>
            <?php } ?>
            </table>

        </div>
    </div>
</body>
</html>