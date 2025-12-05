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
$skupaj = $skupaj2 = 0;
$validRange = [];
foreach($dVrstice as $vrstica) {
	foreach($ranges as [$start, $end]) {
		if(intval($vrstica) >= $start && intval($vrstica) <= $end) {
			$skupaj++;
			$validRange[] = [$start, $end];
			break;
		}
	}
}
//part 2
usort($ranges, fn($a,$b) => $a[0] <=> $b[0]);
$curr_s = $ranges[0][0];
$curr_e = $ranges[0][1];
for($i=1; $i < count($ranges); $i++) {
	$start = $ranges[$i][0];
	$end = $ranges[$i][1];
	if($start <= $curr_e) {
		$curr_e = max($curr_e, $end);
	}else {
		$skupaj2+= ($curr_e - $curr_s +1);
		$curr_s = $start;
		$curr_e = $end;
	}
}
$skupaj2+= ($curr_e - $curr_s +1);
echo 'part 1: '.$skupaj;
echo 'part 2: '.$skupaj2;
