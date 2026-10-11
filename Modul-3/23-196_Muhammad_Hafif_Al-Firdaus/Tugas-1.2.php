<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

// Menghapus elemen "Blueberry" (indeks 1)
unset($fruits[1]);
echo "Data Blueberry dihapus.<br>";

// Mereset atau menampilkan isi array yang tersisa
echo "fruits = (\"" . implode('", "', $fruits) . "\")<br>";

// Mengambil nilai dengan indeks tertinggi
// Menggunakan array_key_last() untuk mengambil kunci/indeks tertinggi meskipun ada indeks yang dihapus
$key_tertinggi = array_key_last($fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[$key_tertinggi];
?>