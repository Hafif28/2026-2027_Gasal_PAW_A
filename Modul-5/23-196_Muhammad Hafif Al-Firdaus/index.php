<?php
include "koneksi.php";
include "header.php";

// Materi 8: Select Data
$sql = "SELECT id, nama, telp, alamat FROM supplier ORDER BY id";
$result = mysqli_query($conn, $sql);
?>
<div class="judul clearfix">
  <a href="tambah.php" class="btn btn-success pull-right" style="margin-top:15px">Tambah Data</a>
  <h3>Data Master Supplier</h3>
</div>

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
      <td><?php echo htmlspecialchars($row["nama"]); ?></td>
      <td><?php echo htmlspecialchars($row["telp"]); ?></td>
      <td><?php echo htmlspecialchars($row["alamat"]); ?></td>
      <td>
        <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
      </td>
    </tr>
<?php
    }
} else {
    echo '<tr><td colspan="5" class="text-center">0 results</td></tr>';
}
mysqli_close($conn);
?>
  </tbody>
</table>
</div>
</body>
</html>
