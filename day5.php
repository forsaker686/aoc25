<?php
$vnos = fopen("day5.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day5.txt"));
fclose($vnos);
$podatki = trim($podatki);
[$range, $data] = preg_split("/\n\s/", $podatki);
$vrstice = preg_split("/\n/", $range);
$ranges = [];
foreach($vrstice as $vrstica) {
	[$start, $end] = explode('-', $vrstica);
	$ranges[] = [intval($start), intval($end)];
}
$dVrstice = preg_split("/\n/", $data);
$skupaj = 0;
foreach($dVrstice as $vrstica) {
	foreach($ranges as [$start, $end]) {
		if(intval($vrstica) >= $start && intval($vrstica) <= $end) {
			$skupaj++;
			break;
		}
	}
}

echo 'part 1: '.$skupaj;
