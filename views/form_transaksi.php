<?php ?>
<h3>Transaksi Baru</h3>
<form method="post">
    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" required value="<?= htmlspecialchars($_POST['tanggal_transaksi'] ?? date('Y-m-d')) ?>" />
    <label for="tipe_pelanggan">Tipe Pelanggan:</label>
    <select id="tipe_pelanggan" name="tipe_pelanggan" required>
        <option value="">-- Pilih Tipe --</option>
        <option value="member">Member</option>
        <option value="customer">Customer</option>
    </select>
    <button type="submit">Lanjut</button>
</form>