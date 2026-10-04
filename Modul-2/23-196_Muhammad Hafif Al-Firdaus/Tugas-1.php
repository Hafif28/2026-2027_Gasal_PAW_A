<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

$jumlahMatkul = count($matkul);

for ($i = 0; $i < $jumlahMatkul; $i++) {
    $namaMatkul = $matkul[$i];
    
    // Mengecek apakah mata kuliah ada di dalam array $praktikum
    if (in_array($namaMatkul, $praktikum)) {
        echo "Saya sedang mengambil matkul " . $namaMatkul . " termasuk praktikum nya<br>";
    } 
    // Mengecek apakah indeks ke-6 atau ke-7
    elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $namaMatkul . "<br>";
    } 
    // Kondisi default/lainnya
    else {
        echo "Saya sudah mengambil matkul " . $namaMatkul . " semester lalu<br>";
    }
}
?>