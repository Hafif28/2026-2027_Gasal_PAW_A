<?php
// 1. array_push
$arr_push = array("A");
array_push($arr_push, "B");
echo "Hasil array_push: " . implode(" ", $arr_push) . "<br><br>";

// 2. array_merge
$arr1 = array("A", "B");
$arr2 = array("C");
$arr_merged = array_merge($arr1, $arr2);
echo "Hasil array_merge: " . implode(" ", $arr_merged) . "<br><br>";

// 3. array_values
$assoc = array("x" => 1, "y" => 2);
$vals = array_values($assoc);
echo "Hasil array_values: " . implode(" ", $vals) . "<br><br>";

// 4. array_search
$search_arr = array("A", "B", "C");
$key_found = array_search("B", $search_arr);
echo "Hasil array_search: " . $key_found . "<br><br>";

// 5. array_filter
$filter_arr = array(0, 1, false, 2, "", 3, "array");
$filtered = array_filter($filter_arr);
echo "Hasil array_filter: " . implode(" ", $filtered) . "<br><br>";

// 6. Sorting Array Terindeks (sort & rsort)
$num_arr = array(3, 1, 2);

$s_arr = $num_arr;
sort($s_arr);
echo "Hasil sort: " . implode("", $s_arr) . "<br>";

$rs_arr = $num_arr;
rsort($rs_arr);
echo "Hasil rsort: " . implode("", $rs_arr) . "<br><br>";

// 7. Sorting Array Asosiatif (asort, ksort, arsort, krsort)
$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);

// asort (urut nilai ascending)
$a1 = $age; asort($a1);
echo "Hasil asort: "; foreach($a1 as $k=>$v) echo "$k=>$v, "; echo "<br>";

// ksort (urut kunci ascending)
$a2 = $age; ksort($a2);
echo "Hasil ksort: "; foreach($a2 as $k=>$v) echo "$k=>$v, "; echo "<br>";

// arsort (urut nilai descending)
$a3 = $age; arsort($a3);
echo "Hasil arsort: "; foreach($a3 as $k=>$v) echo "$k=>$v, "; echo "<br>";

// krsort (urut kunci descending)
$a4 = $age; krsort($a4);
echo "Hasil krsort: "; foreach($a4 as $k=>$v) echo "$k=>$v, "; echo "<br>";
?>