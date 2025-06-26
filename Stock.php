<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>
    <header class="bg-primary text-white text-center py-5   header">
        <h1>Stock Management</h1>
        <p class="lead">Welcome to the Stock Management System</p>
    </header>
    <div class="container">
        <div class="content mt-3" >
            <h2>Stock List</h2>
            <Table  class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>entry date</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php 
                require "OOP.php";
                $Stk = new Stock();
                $products = $Stk->getAllProduk();
                foreach ($products as $p){
                ?>
                <tbody>
                    <tr>
                        <td><?= $p['Id_Produk']?></td>
                        <td><?= $p['Nama_Produk']?></td>
                        <td><?= $p['Harga']?></td>
                        <td><?= $p['Kuantitas_Produk']?></td>
                        <td><?= $p['Tanggal_Masuk']?></td>
                        <td>
                            <a href="editStock.php?Id_Inventaris=<?= $p['Id_Inventaris'] ?>"><button class="btn btn-warning">Edit</button></a>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </Table>
        </div>
    </div>
</body>
</html>