<?php
require_once __DIR__ . '/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
</head>
<body>
    <h2>Daftar Barang</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($b = mysqli_fetch_assoc($q)) {
            echo "<tr>
                    <td>{$b['id']}</td>
                    <td>{$b['kode_barang']}</td>
                    <td>{$b['nama_barang']}</td>
                    <td>Rp " . number_format($b['harga'], 0, ',', '.') . "</td>
                    <td>{$b['stok']}</td>
                    <td>
                        <a href='hapus_barang.php?id={$b['id']}'>Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>