<?php
// Data awal
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// Menambahkan 5 data baru
array_push($students, 
    array("Daniel", "220404", "0812345611"),
    array("Elena", "220405", "0812345622"),
    array("Fiona", "220406", "0812345633"),
    array("Gabe", "220407", "0812345644"),
    array("Hannah", "220408", "0812345655")
);

// Menampilkan dalam bentuk tabel HTML
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach ($students as $row) {
    echo "<tr>";
    foreach ($row as $col) {
        echo "<td>" . $col . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>