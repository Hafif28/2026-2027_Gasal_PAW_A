<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$formatted = [];
foreach ($weight as $k => $v) {
    $formatted[] = "\"$k\"=>\"$v\"";
}
echo implode(", ", $formatted) . ")<br>";

// Mengakses data kedua ("Barry")
// Pada array asosiatif, kita dapat mengakses langsung berdasarkan key atau mengambil nilainya berdasarkan urutan
$values = array_values($weight);
echo "Data kedua: " . $values[1];
?>