<?php
$vnos = fopen("day1.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day1.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$start = 50;
$stevec = $stevec2 = 0;  

foreach($vrstice as $vrstica) {
    $smer = substr($vrstica, 0, 1);
    $vrednost = intval(substr($vrstica, 1));

    for($i = 0; $i < $vrednost; $i++) {
        if ($smer == 'L') {
            $start--;
            if ($start < 0) $start = 99;
        } else {
            $start++;
            if ($start > 99) $start = 0;
        }
        if ($start == 0) {
            $stevec2++;
        }
    }
    if ($start == 0) {
        $stevec++;
    }
}

echo "part 1: ".$stevec."<br>";
echo "part 2: ".$stevec2;
?>
