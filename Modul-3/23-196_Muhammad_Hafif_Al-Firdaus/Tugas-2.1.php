<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan 5 data baru
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}

// Menghitung panjang array terbaru
$arrlength = count($fruits);
echo "Panjang array saat ini: " . $arrlength . "<br>";

// Menampilkan seluruh data
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
?>