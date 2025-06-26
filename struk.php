<?php
require "konek.php";
$id_transaksi = (int)($_GET['id'] ?? 0);
$struk = [];

if ($id_transaksi > 0) {
    $sql = "SELECT t.Id_Transaksi, t.Tanggal_Transaksi, t.Nama_Customer, t.No_Telp, t.Id_MetodePembayaran, m.Nama_Metode, t.Id_Karyawan, k.Nama_Karyawan
            FROM Transaksi t
            JOIN Metode_Pembayaran m ON t.Id_MetodePembayaran = m.Id_MetodePembayaran
            JOIN Karyawan k ON t.Id_Karyawan = k.Id_Karyawan
            WHERE t.Id_Transaksi = $id_transaksi";
    $result = $con->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $struk = $row;
        $struk['detail'] = [];
        $sql2 = "SELECT d.*, pr.Nama_Produk, s.Size
                 FROM Transaksi_Detail d
                 JOIN Produk pr ON d.Id_Produk = pr.Id_Produk
                 LEFT JOIN Size s ON d.Id_Size = s.Id_Size
                 WHERE d.Id_Transaksi = $id_transaksi";
        $result2 = $con->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
            $struk['detail'][] = $row2;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <link rel="stylesheet" href="transaksi.css">
</head>
<body>
<div class="container">
    <?php if (!empty($struk)): ?>
        <div class="struk" style="max-width:400px;margin:32px auto 0 auto;padding:24px 18px;background:#fff;border:1px solid #eee;border-radius:8px;">
            <h4 style="margin-top:0;text-align:center;">STRUK TRANSAKSI</h4>
            <table style="width:100%;font-size:0.98em;">
                <tr><td><b>No. Transaksi</b></td><td>: <?= $struk['Id_Transaksi'] ?></td></tr>
                <tr><td><b>Tanggal</b></td><td>: <?= htmlspecialchars($struk['Tanggal_Transaksi']) ?></td></tr>
                <?php if (isset($struk['Nama_Customer'])): ?>
                    <tr><td><b>Customer</b></td><td>: <?= htmlspecialchars($struk['Nama_Customer']) ?></td></tr>
                <?php endif; ?>
                <?php if (isset($struk['No_Telp'])): ?>
                    <tr><td><b>No Telp</b></td><td>: <?= htmlspecialchars($struk['No_Telp']) ?></td></tr>
                <?php endif; ?>
                <?php if (isset($struk['Nama_Karyawan'])): ?>
                    <tr><td><b>Kasir</b></td><td>: <?= htmlspecialchars($struk['Nama_Karyawan']) ?></td></tr>
                <?php endif; ?>
                <?php if (isset($struk['Nama_Metode'])): ?>
                    <tr><td><b>Pembayaran</b></td><td>: <?= htmlspecialchars($struk['Nama_Metode']) ?></td></tr>
                <?php endif; ?>
            </table>
            <hr>
            <table style="width:100%;font-size:0.98em;">
                <thead>
                    <tr>
                        <th style="text-align:left;">Produk</th>
                        <th style="text-align:left;">Size</th>
                        <th style="text-align:right;">Qty</th>
                        <th style="text-align:right;">Harga</th>
                        <th style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php $grand = 0; foreach ($struk['detail'] as $d): $grand += $d['Subtotal']; ?>
                    <tr>
                        <td><?= htmlspecialchars($d['Nama_Produk']) ?></td>
                        <td><?= htmlspecialchars($d['Size'] ?? '-') ?></td>
                        <td style="text-align:right;"><?= $d['Jumlah_Produk'] ?></td>
                        <td style="text-align:right;"><?= number_format($d['Harga_Satuan'],0,',','.') ?></td>
                        <td style="text-align:right;"><?= number_format($d['Subtotal'],0,',','.') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align:right;"><b>Total</b></td>
                        <td style="text-align:right;"><b><?= number_format($grand,0,',','.') ?></b></td>
                    </tr>
                </tfoot>
            </table>
            <div style="text-align:center;margin-top:16px;font-size:0.95em;color:#888;">Terima kasih!</div>
        </div>
    <?php else: ?>
        <div style="text-align:center;margin-top:40px;">Struk tidak ditemukan.</div>
    <?php endif; ?>
    <div style="text-align:center;margin-top:24px;">
        <a href="transaksi.php">Kembali ke Transaksi</a>
    </div>
</div>
</body>
</html>