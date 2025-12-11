<?php
$vnos = fopen("day10.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day10.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
function minPritiskov($tarcaM, $tipke) {
    $start = 0;
    $obiskani = [];
    $vrsta = new SplQueue();
    $vrsta->enqueue([$start, 0]);
    $obiskani[$start] = true;
    while (!$vrsta->isEmpty()) {
        [$stanje, $pritiskov] = $vrsta->dequeue();
        if ($stanje === $tarcaM) {
            return $pritiskov;
        }
        foreach ($tipke as $tipka) {
            $nStanje = $stanje ^ $tipka;
            if (!isset($obiskani[$nStanje])) {
                $obiskani[$nStanje] = true;
                $vrsta->enqueue([$nStanje, $pritiskov + 1]);
            }
        }
    }
    return 0;
}
$minPritiskov = [];
foreach($vrstice as $vrstica) {
    preg_match('/\[(.*?)\]/', $vrstica, $stanje);
    $stanje = str_split($stanje[1]); //[.#.#.]

    preg_match_all('/\((.*?)\)/', $vrstica, $tipke); // (1,3) (3,5,6)
    $gumbi = [];
    foreach ($tipke[1] as $gumb) {
        $gumbi[] = array_map('intval', explode(',', $gumb));
    }
	$tarcaM = 0;
	foreach ($stanje as $i => $c) {
	    if ($c === '#') {
	        $tarcaM |= (1 << $i);
	    }
	}
	$gumbM = [];
	foreach ($gumbi as $gumb) {
	    $maska = 0;
	    foreach ($gumb as $idx) {
	        $maska |= (1 << $idx);
	    }
	    $gumbM[] = $maska;
	}
    $min = minPritiskov($tarcaM, $gumbM);
    $minPritiskov[] = $min;
}
echo 'part 1:'.array_sum($minPritiskov);
