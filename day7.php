<?php
$vnos = fopen("day7.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day7.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$zacetna = 0;
for($i=0;$i< strlen($vrstice[0]); $i++) {
	if($vrstice[0][$i] == 'S') {
		$zacetna = $i;
	}
}
$aktivni = [ $zacetna ];
$splits = 0;
for($i =1;  $i < count($vrstice); $i++) {
	$novi = [];
	foreach($aktivni as $a) {
		if($a < 0 || $a >= count($vrstice)){
			continue;
		}
		$celica = $vrstice[$i][$a];
		if($vrstice[$i][$a] == '^') {
			$splits++;
			if($a-1 >= 0) {
				$novi[] = $a-1;
			}
			if($a+1 < count($vrstice)) {
				$novi[] = $a+1;
			}
		}else {
			$novi[] = $a;
		}
	}
	if(count($novi) === 0) {
		$aktivni = [];
		break;
	}
	$aktivni = array_values(array_unique($novi));
}
echo 'part 1: '.$splits;
