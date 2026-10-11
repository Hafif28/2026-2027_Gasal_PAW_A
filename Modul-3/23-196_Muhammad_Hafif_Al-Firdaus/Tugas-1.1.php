<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan 5 data baru
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

// Menampilkan seluruh isi array
echo "fruits = (\"" . implode('", "', $fruits) . "\")<br>";

// Mengambil nilai dengan indeks tertinggi menggunakan end() atau $fruits[count($fruits)-1]
$indeks_tertinggi = $fruits[count($fruits) - 1];
echo "Nilai dengan indeks tertinggi: " . $indeks_tertinggi;
?>