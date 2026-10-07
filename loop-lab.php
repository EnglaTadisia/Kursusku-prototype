<?php

// A. for
for ($i = 1; $i <= 5; $i++) {
    echo "Pertemuan ke-$i<br>";
}

echo "<hr>";

// B. while
$i = 1;
while ($i <= 5) {
    echo "Nomor antrean: $i<br>";
    $i++;
}

echo "<hr>";

// C. do-while
$i = 1;
do {
    echo "Percobaan ke-$i<br>";
    $i++;
} while ($i <= 5);

?>