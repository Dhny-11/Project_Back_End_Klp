<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>
    <header class="bg-primary text-white text-center py-5   header">
        <h1>Manajemen Karyawan</h1>
        <p class="lead">Selamat Datang di Sistem Manajemen Karyawan</p>
    </header>
    <div class="container">
        <div class="content mt-3" >
            <h2></h2>
            <Table  class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Name</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php 
                require "OOP.php";
                $Kry = new Karyawan();
                $orang = $Kry->getAllKaryawan();
                foreach ($orang as $k){
                ?>
                <tbody>
                    <tr>
                        <td><?= $k['Id_Karyawan']?></td>
                        <td><?= $k['Nama_Karyawan']?></td>
                        <td><?= $k['Nomor_Telepon']?></td>
                        <td><?= $k['Email']?></td>
                        <td><?= $k['Alamat']?></td>
                        <td>
                            <a href="editKaryawan.php?Id_Karyawan=<?= $k['Id_Karyawan'] ?>"><button class="btn btn-warning">Edit</button></a>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </Table>
        </div>
    </div>
</body>
</html>

