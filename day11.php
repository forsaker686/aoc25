<?php
$vnos = fopen("day11.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day11.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$skupaj = 0;
$poti = [];
$rezultati = [];
function isci($device, $pot, $graf) {
	global $rezultati;
	foreach($graf[$device] as $output) {
		if($output == 'out') {
			$pot[] = 'out';
			$rezultati[] = $pot;
			continue;
		}
		if(in_array($output, $pot)) {
			continue;
		}
		$next = array_merge($pot, [$output]);
        isci($output, $next, $graf);
	}
}
foreach($vrstice as $vrstica) {
	[$device, $list] = explode (':', $vrstica);
	$list = explode(' ', trim($list));
	$poti[$device] = $list;
}
isci('you', ['you'], $poti);
echo 'part 1:'.count($rezultati);
