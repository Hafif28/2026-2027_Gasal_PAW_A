<?php
$conn = require __DIR__ . "/koneksi.php";

$result = false;
$queryError = null;
try {
    // Materi 8: Select Data
    $result = mysqli_query($conn, "SELECT id, nama, telp, alamat FROM supplier ORDER BY id");
    if ($result === false) {
        $queryError = mysqli_error($conn);
    }
} catch (mysqli_sql_exception $exception) {
    $queryError = $exception->getMessage();
}

if ($queryError !== null) {
    error_log("Gagal mengambil data supplier: " . $queryError);
}

include "header.php";
?>
<div class="judul clearfix">
  <a href="tambah.php" class="btn btn-success pull-right" style="margin-top:15px">Tambah Data</a>
  <h3>Data Master Supplier</h3>
</div>

<?php if ($queryError !== null) { ?>
  <div class="alert alert-danger" role="alert">
    Data supplier gagal dimuat. Pastikan tabel <strong>supplier</strong> tersedia di database yang dikonfigurasi.
  </div>
<?php } else { ?>
<table class="table table-bordered">
  <thead>
    <tr><th>No</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Tindakan</th></tr>
  </thead>
  <tbody>
<?php
if (mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo htmlspecialchars((string) ($row["nama"] ?? ""), ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlspecialchars((string) ($row["telp"] ?? ""), ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlspecialchars((string) ($row["alamat"] ?? ""), ENT_QUOTES, "UTF-8"); ?></td>
      <td>
        <a href="edit.php?id=<?php echo (int) $row["id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?php echo (int) $row["id"]; ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
      </td>
    </tr>
<?php
    }
} else {
    echo '<tr><td colspan="5" class="text-center">0 results</td></tr>';
}
mysqli_free_result($result);
?>
  </tbody>
</table>
<?php } ?>
<?php
mysqli_close($conn);
?>
</div>
</body>
</html>
