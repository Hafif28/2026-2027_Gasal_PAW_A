<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

// Karena perulangan 'for' membutuhkan indeks numerik, kita konversi kunci dan nilainya ke array terindeks
$keys = array_keys($weight);
$values = array_values($weight);
$length = count($weight);

for ($i = 0; $i < $length; $i++) {
    echo $keys[$i] . " is " . $values[$i] . " kg.<br>";
}
?>