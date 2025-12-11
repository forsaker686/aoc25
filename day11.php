<?php
$vnos = fopen("day11.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day11.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$skupaj = 0;
$poti = [];
$rezultati = $rezultati2 [];
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

//part 2 - wokrs on example, too much time for real input
function isci2($device, $pot, $graf, $videlDac = false, $videlFft = false) {
	global $rezultati2;
    if ($device === 'dac') $videlDac = true;
    if ($device === 'fft') $videlFft = true;
	foreach($graf[$device] as $output) {
		if($output == 'out') {
            if ($videlDac && $videlFft) {
                $rezultati2[] = array_merge($pot, ['out']);
            }
            continue;
		}
		if(in_array($output, $pot)) {
			continue;
		}
			$pot[] = $output;
			isci2($output, $pot, $graf, $videlDac, $videlFft);
			array_pop($pot);
	}
}
isci2('svr', ['svr'], $poti);

echo 'part 2:'.count($rezultati2);
