<?php
$conn = require __DIR__ . "/koneksi.php";

$nama = "";
$telp = "";
$alamat = "";
$errors = [];

if (isset($_POST["simpan"])) {
    $values = [];
    foreach (["nama", "telp", "alamat"] as $field) {
        if (!isset($_POST[$field]) || !is_string($_POST[$field])) {
            $errors[] = "Input kolom " . $field . " tidak valid.";
            $values[$field] = "";
        } else {
            $values[$field] = trim($_POST[$field]);
        }
        if ($values[$field] === "") {
            $errors[] = "Kolom " . $field . " wajib diisi.";
        }
    }
    $nama = $values["nama"];
    $telp = $values["telp"];
    $alamat = $values["alamat"];

    $namaLength = preg_match_all('/./us', $nama);
    $telpLength = preg_match_all('/./us', $telp);
    if ($namaLength === false || $telpLength === false) {
        $errors[] = "Data harus menggunakan teks UTF-8 yang valid.";
    } else {
        if ($namaLength > 100) {
            $errors[] = "Nama maksimal 100 karakter.";
        }
        if ($telpLength > 12) {
            $errors[] = "Nomor telepon maksimal 12 karakter.";
        }
    }

    if (empty($errors)) {
        $stmt = null;
        try {
            // Materi 4 & 7: Insert data dengan prepared statement
            $stmt = $conn->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
            if ($stmt === false) {
                $errors[] = "Gagal menyiapkan query: " . htmlspecialchars($conn->error, ENT_QUOTES, "UTF-8");
            } else {
                $stmt->bind_param("sss", $nama, $telp, $alamat);
                if ($stmt->execute()) {
                    $stmt->close();
                    mysqli_close($conn);
                    header("Location: index.php");
                    exit;
                }

                $errors[] = "Gagal menyimpan data: " . htmlspecialchars($stmt->error, ENT_QUOTES, "UTF-8");
                $stmt->close();
            }
        } catch (mysqli_sql_exception $exception) {
            if ($stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
            error_log("Gagal menyimpan supplier: " . $exception->getMessage());
            $errors[] = "Terjadi kesalahan saat menyimpan data. Silakan coba lagi.";
        }
    }
}
include "header.php";
?>
<div class="judul"><h3 style="font-size:28px">Tambah Data Master Supplier Baru</h3></div>

<?php if (!empty($errors)) { ?>
  <div class="alert alert-danger" role="alert">
    <ul>
      <?php foreach ($errors as $error) { ?>
        <li><?php echo $error; ?></li>
      <?php } ?>
    </ul>
  </div>
<?php } ?>

<form method="post" action="tambah.php" class="form-horizontal" style="margin-top:30px">
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5"><input type="text" name="nama" class="form-control" placeholder="Nama" maxlength="100" value="<?php echo htmlspecialchars($nama, ENT_QUOTES, "UTF-8"); ?>" required></div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Telp</label>
    <div class="col-sm-3"><input type="text" name="telp" class="form-control" placeholder="telp" maxlength="12" value="<?php echo htmlspecialchars($telp, ENT_QUOTES, "UTF-8"); ?>" required></div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-3"><input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php echo htmlspecialchars($alamat, ENT_QUOTES, "UTF-8"); ?>" required></div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
  </div>
</form>
</div>
</body>
</html>
