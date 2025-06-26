<?php // views/form_member.php ?>
<h3>Transaksi Member</h3>
<form method="post">
    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" required value="<?= htmlspecialchars($_POST['tanggal_transaksi'] ?? date('Y-m-d')) ?>" />

    <label for="member_id">Nama Member:</label>
    <select id="member_id" name="member_id" required>
        <option value="">-- Pilih Member --</option>
        <?php while ($row = $members->fetch_assoc()): ?>
            <option value="<?= $row['Id_Customer'] ?>" <?= (isset($_POST['member_id']) && $_POST['member_id'] == $row['Id_Customer']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['Nama_Customer']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <div id="produk-list">
        <div class="produk-item">
            <label>Produk:</label>
            <select name="product_id[]" required>
                <option value="">-- Pilih Produk --</option>
                <?php
                $result = $produk->getAll();
                while ($row = $result->fetch_assoc()):
                ?>
                    <option value="<?= $row['Id_Produk'] ?>"><?= htmlspecialchars($row['Nama_Produk']) ?></option>
                <?php endwhile; ?>
            </select>
            <label>Size:</label>
            <select name="size_id[]" required>
                <option value="">-- Pilih Size --</option>
                <?php
                $resultSize = $size->getAll();
                while ($rowS = $resultSize->fetch_assoc()):
                ?>
                    <option value="<?= $rowS['Id_Size'] ?>"><?= htmlspecialchars($rowS['Size']) ?></option>
                <?php endwhile; ?>
            </select>
            <label>Jumlah:</label>
            <input type="number" name="jumlah_produk[]" min="1" value="1" required>
            <button type="button" onclick="removeProduk(this)">Hapus</button>
        </div>
    </div>
    <button type="button" onclick="tambahProduk()">Tambah Produk</button>

    <label for="payment_id">Metode Pembayaran:</label>
    <select id="payment_id" name="payment_id" required>
        <option value="">-- Pilih Metode --</option>
        <?php while ($row = $payments->fetch_assoc()): ?>
            <option value="<?= $row['Id_MetodePembayaran'] ?>" <?= (isset($_POST['payment_id']) && $_POST['payment_id'] == $row['Id_MetodePembayaran']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['Nama_Metode']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="employee_id">Karyawan:</label>
    <select id="employee_id" name="employee_id" required>
        <option value="">-- Pilih Karyawan --</option>
        <?php while ($row = $employees->fetch_assoc()): ?>
            <option value="<?= $row['Id_Karyawan'] ?>" <?= (isset($_POST['employee_id']) && $_POST['employee_id'] == $row['Id_Karyawan']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['Nama_Karyawan']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Simpan Transaksi Member</button>
</form>
<a class="back-link" href="?page=transaksi">Kembali</a>

<script>
function tambahProduk() {
    var produkList = document.getElementById('produk-list');
    var first = produkList.querySelector('.produk-item');
    var clone = first.cloneNode(true);
    // Reset value
    clone.querySelector('select').selectedIndex = 0;
    clone.querySelector('input').value = 1;
    produkList.appendChild(clone);
}
function removeProduk(btn) {
    var produkList = document.getElementById('produk-list');
    if (produkList.children.length > 1) {
        btn.parentElement.remove();
    }
}
</script>