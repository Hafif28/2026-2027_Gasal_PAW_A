<?php
require_once __DIR__ . '/koneksi.php';

if (isset($_GET['id'])) {
    $id_barang = intval($_GET['id']);

    // Cek apakah barang sudah digunakan di transaksi_detail
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi_detail WHERE barang_id = $id_barang");
    $data = mysqli_fetch_assoc($cek);

    if ($data['total'] > 0) {
        echo "<script>
                alert('Gagal Hapus! Data barang ini masih digunakan pada transaksi.');
                window.location.href='transaksi_detail.php?id=1';
            </script>";
    } else {
        $del = mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id_barang");
        if ($del) {
            echo "<script>
                    alert('Data barang berhasil dihapus.');
                    window.location.href='transaksi_detail.php?id=1';
                </script>";
        }
    }
} else {
    echo "ID Barang tidak ditemukan. Silakan tambahkan parameter ?id=1 pada URL.";
}
?>