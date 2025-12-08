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

echo 'part 1:'.$splits;

//part 2
$aktivni = [ $zacetna => 1 ];
$splits2 = 0;
for($i =1;  $i < count($vrstice); $i++) {
	$novi = [];
	foreach($aktivni as $a => $stej) {
		if($a < 0 || $a >= strlen($vrstice[$i])){
			continue;
		}
		if($vrstice[$i][$a] == '^') {
			if($a-1 >= 0) {
				$novi[$a-1] = (isset($novi[$a-1]) ? bcadd($novi[$a-1], $stej) : $stej);
			}
			if($a+1 < strlen($vrstice[$i])) {
				$novi[$a+1] = (isset($novi[$a+1]) ? bcadd($novi[$a+1], $stej) : $stej);
			}
		}else {
			$novi[$a] = (isset($novi[$a]) ? bcadd($novi[$a], $stej) : $stej);
		}
	}
	if(count($novi) === 0) {
		$aktivni = [];
		break;
	}
	$aktivni = $novi;
}

foreach ($aktivni as $v) { 
	$splits2 = bcadd($splits2, (string)$v); 
}

echo 'part 2: '.$splits2;
