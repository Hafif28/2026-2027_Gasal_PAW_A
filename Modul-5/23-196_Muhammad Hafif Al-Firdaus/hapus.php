<?php
include "koneksi.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID supplier tidak valid. <a href='index.php'>Kembali</a>");
}
$id = (int) $_GET["id"];

// Materi 9: Hapus data
$sql = "DELETE FROM supplier WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
