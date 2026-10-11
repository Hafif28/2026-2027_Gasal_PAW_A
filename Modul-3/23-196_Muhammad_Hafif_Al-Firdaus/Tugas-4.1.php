<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Menambah 5 data baru
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

// Menampilkan seluruh data dengan foreach
foreach ($height as $name => $h) {
    echo $name . " is " . $h . " cm tall.<br>";
}
?>