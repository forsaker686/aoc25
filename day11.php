<?php
$vnos = fopen("day11.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day11.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$skupaj = 0;
$poti = [];
$rezultati = $rezultati2 = [];
//part 1 function
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
//part 2 function
function isci2($device, $videlDac = 0,  $videlFft = 0) {
	global $poti;
	static $cache = [];

	if($device == 'out') {
		return $videlDac && $videlFft;
	}
	$key = "$device,$videlDac,$videlFft";
	if(isset($cache[$key])) {
		return $cache[$key];
	}
	$rezultat = 0;
	foreach($poti[$device] as $output) {
		$rezultat += isci2($output, $videlDac || $output == 'dac', $videlFft || $output == 'fft');
	}
	return $cache[$key] = $rezultat;
}
foreach($vrstice as $vrstica) {
	[$device, $list] = explode (':', $vrstica);
	$list = explode(' ', trim($list));
	$poti[$device] = $list;
}

isci('you', ['you'], $poti);
echo 'part 1:'.count($rezultati);
echo '<br/>';
$part2 = isci2("svr");
echo 'part 2:'.$part2;
