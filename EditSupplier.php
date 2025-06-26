<?php
require "OOP.php";
$Supp = new Supplier();
$id_supplier = $_GET['Id_Supplier'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>
    <header class = " bg-primary text-white text-center py-5   header" style="justify-content: center;">
        <h1>Edit Supplier</h1>
    </header>
    <div class="container">
        <div class="content">
            <form action="EditSupPross.php" class="form" method="POST">
                <input type="hidden" name="Id_Supplier" value="<?= $id_supplier ?>">
                <?php
                $data = $Supp->getSupplierById($id_supplier);
                if ($data) {
                ?>
                <label for="Nama_Supplier" style="font-size: 1.5rem;">Nama Supplier:</label>
                <input type="text" class="form-control" id="Nama_Supplier" name="Nama_Supplier" value="<?= $data['Nama_Supplier'] ?>" required><br>
                
                <label for="Nomor_Telepon">Nomor Telepon:</label>
                <input type="text" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon" value="<?= $data['Nomor_Telepon'] ?>" required><br>
                
                <label for="Email_Perusahaan">Email Perusahaan:</label>
                <input type="email" class="form-control" id="Email_Perusahaan" name="Email_Perusahaan" value="<?= $data['Email_Perusahaan'] ?>" required><br>

                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <?php } else { ?>
                    <p>Data tidak ditemukan.</p>
                <?php } ?>  


            </form>
        </div>
    </div>
</body>
</html>