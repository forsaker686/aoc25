<?php
$vnos = fopen("day3.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day3.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
function maxB($s) {
    $maxRight = -1;
    $best = -1;
    for ($i = strlen($s) - 1; $i >= 0; $i--) {
        $d = intval($s[$i]);
        if ($maxRight !== -1) {
            $candidate = 10 * $d + $maxRight;
            if ($candidate > $best) {
                $best = $candidate;
            }
        }
        if ($d > $maxRight) {
            $maxRight = $d;
        }
    }
    return $best !== -1 ? $best : null;
}
function largestB($s) {
    $s = trim($s);
    $digits = str_split($s);
    $remove = strlen($s) - 12;
    $stack = [];
    foreach ($digits as $d) {
        while (!empty($stack) &&
               end($stack) < $d &&
               $remove > 0 &&
               (count($stack) - 1 + (count($digits) - count($stack)) >= 12)) {
            array_pop($stack);
            $remove--;
        }
        $stack[] = $d;
    }
    return implode('', array_slice($stack, 0, 12));
}

$numbers = $numbers2 =  [];
foreach($vrstice as $vrstica) {
	$numbers[] = maxB(trim($vrstica));
	$numbers2[] = largestB($vrstica);
}
echo 'part 1:'.array_sum($numbers);
echo 'part 2:'.array_sum($numbers2);
