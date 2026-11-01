<?php
include "koneksi.php";

// Validasi id
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID supplier tidak valid. <a href='index.php'>Kembali</a>");
}
$id = (int) $_GET["id"];

// Materi 10: Ubah data dengan prepared statement
if (isset($_POST["update"])) {
    $nama   = $_POST["nama"];
    $telp   = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $stmt = $conn->prepare("UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");
    $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
    if ($stmt->execute()) {
        $stmt->close();
        mysqli_close($conn);
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Materi 8: Select data lama
$result = mysqli_query($conn, "SELECT id, nama, telp, alamat FROM supplier WHERE id=$id");
if (mysqli_num_rows($result) == 0) {
    die("Data supplier tidak ditemukan. <a href='index.php'>Kembali</a>");
}
$row = mysqli_fetch_assoc($result);
include "header.php";
?>
<div class="judul"><h3 style="font-size:28px">Edit Data Master Supplier</h3></div>

<form method="post" action="edit.php?id=<?php echo $id; ?>" class="form-horizontal" style="margin-top:30px">
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5"><input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($row["nama"]); ?>" required></div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Telp</label>
    <div class="col-sm-3"><input type="text" name="telp" class="form-control" value="<?php echo htmlspecialchars($row["telp"]); ?>" maxlength="12" required></div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-3"><input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($row["alamat"]); ?>" required></div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" name="update" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
  </div>
</form>
</div>
<?php mysqli_close($conn); ?>
</body>
</html>
