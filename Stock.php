<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
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
    <header class="bg-primary text-white text-center py-5   header">
        <h1>Produk Manajemen</h1>
        <p class="lead">Selamat Datang Di Sistem Manajemen Produk</p>
        <nav class="d-flex justify-content-center">
            <a href="">Home</a>
            <a href="Suplier.php" > Supplier</a>
        </nav>
    </header>
    <div class="container">
        <div class="content mt-3" >
            <h2>Stock List</h2>
            <a href="tambah_produk.php" class="btn btn-success mb-3">+ Tambah Produk Baru</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>entry date</th>
                        <th>Supplier</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                require "OOP.php";
                $Stk = new Stock();
                $products = $Stk->getAllProduk();
                foreach ($products as $p){
                ?>
                    <tr>
                        <td><?= $p['Id_Produk']?></td>
                        <td><?= $p['Nama_Produk']?></td>
                        <td><?= $p['Harga']?></td>
                        <td><?= $p['Kuantitas_Produk']?></td>
                        <td><?= htmlspecialchars($p['Size'] ?? '-') ?></td>
                        <td><?= $p['Tanggal_Masuk']?></td>
                        <td><?= htmlspecialchars($p['Nama_Supplier'] ?? '-') ?></td>
                        <td>
                            <a href="editStock.php?Id_Inventaris=<?= $p['Id_Inventaris'] ?>">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>