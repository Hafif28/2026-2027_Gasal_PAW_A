<?php
require_once __DIR__ . '/koneksi.php';

$transaksi_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// PROSES INPUT DETAIL (Soal 4: Hitung ulang total otomatis)
if (isset($_POST['tambah_detail'])) {
    $barang_id = intval($_POST['barang_id']);
    $qty       = intval($_POST['qty']);

    // Ambil harga barang
    $q_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id");
    $d_brg = mysqli_fetch_assoc($q_brg);
    $harga = $d_brg['harga'];

    // Simpan ke transaksi_detail
    $ins = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
                                VALUES ($transaksi_id, $barang_id, $harga, $qty)");

    if ($ins) {
        // Recalculate & auto update total transaksi
        $q_sum = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total_baru FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
        $d_sum = mysqli_fetch_assoc($q_sum);
        $total_baru = $d_sum['total_baru'] ?? 0;

        mysqli_query($koneksi, "UPDATE transaksi SET total = $total_baru WHERE id = $transaksi_id");
        header("Location: transaksi_detail.php?id=$transaksi_id");
        exit;
    }
}

// Data Master Transaksi
$q_master = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan 
                                FROM transaksi t 
                                LEFT JOIN pelanggan p ON t.pelanggan_id = p.id 
                                WHERE t.id = $transaksi_id");
$master = mysqli_fetch_assoc($q_master);

// Daftar Barang yang SUDAH diinput pada transaksi ini (Soal 2)
$q_existing = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
$existing_barang = [];
while ($r = mysqli_fetch_assoc($q_existing)) {
    $existing_barang[] = $r['barang_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Master Detail Transaksi</title>
</head>
<body>
    <h2>Data Master Transaksi</h2>
    <table border="1" cellpadding="6">
        <tr><th>ID Transaksi</th><td><?= $master['id'] ?></td></tr>
        <tr><th>Waktu</th><td><?= $master['waktu_transaksi'] ?></td></tr>
        <tr><th>Pelanggan</th><td><?= $master['nama_pelanggan'] ?></td></tr>
        <tr><th>Keterangan</th><td><?= $master['keterangan'] ?></td></tr>
        <tr><th>Total Belanja</th><td><b>Rp <?= number_format($master['total'], 0, ',', '.') ?></b></td></tr>
    </table>

    <hr>

    <h3>Input Detail Barang</h3>
    <form method="POST">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $q_all_brg = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($b = mysqli_fetch_assoc($q_all_brg)) {
                $is_selected = in_array($b['id'], $existing_barang);
                // Barang yang sudah diinput di-disabled / disembunyikan (Soal 2)
                $disabled = $is_selected ? "disabled" : "";
                $label_extra = $is_selected ? " (Sudah ditambahkan)" : "";
                echo "<option value='{$b['id']}' $disabled>{$b['kode_barang']} - {$b['nama_barang']} (Rp{$b['harga']})$label_extra</option>";
            }
            ?>
        </select>
        <label>Qty:</label>
        <input type="number" name="qty" min="1" value="1" required>
        <button type="submit" name="tambah_detail">Tambah ke Detail</button>
    </form>

    <br>
    <h3>Rincian Barang (Detail)</h3>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $q_detail = mysqli_query($koneksi, "SELECT td.*, b.kode_barang, b.nama_barang 
                                            FROM transaksi_detail td 
                                            JOIN barang b ON td.barang_id = b.id 
                                            WHERE td.transaksi_id = $transaksi_id");
        while ($d = mysqli_fetch_assoc($q_detail)) {
            $subtotal = $d['harga'] * $d['qty'];
            echo "<tr>
                    <td>{$d['kode_barang']}</td>
                    <td>{$d['nama_barang']}</td>
                    <td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>
                    <td>{$d['qty']}</td>
                    <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>