<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Menambahkan 5 data baru
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

// Menampilkan bentuk array
echo "height = (";
$formatted = [];
foreach ($height as $k => $v) {
    $formatted[] = "\"$k\"=>\"$v\"";
}
echo implode(", ", $formatted) . ")<br>";

// Menampilkan nilai dengan indeks (kunci) terakhir
$last_key = array_key_last($height);
echo "Nilai dengan indeks terakhir: " . $height[$last_key] . "<br><br>";

// Hapus satu data tertentu ("Barry")
unset($height["Barry"]);

// Menampilkan array setelah penghapusan
echo "height = (";
$formatted = [];
foreach ($height as $k => $v) {
    $formatted[] = "\"$k\"=>\"$v\"";
}
echo implode(", ", $formatted) . ")<br>";

// Menampilkan nilai dengan indeks terakhir setelah penghapusan
$last_key_after = array_key_last($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[$last_key_after];
?>