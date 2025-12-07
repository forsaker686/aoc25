<?php
$vnos = fopen("day6.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day6.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$stevilke = $operator =  [];
foreach($vrstice as $vrstica) {
	$podatki = preg_split("/\s/", $vrstica);
	$stevec = 0;
	foreach($podatki as $podatek) {
		if(preg_match("/\d+/", $podatek)) {
			$stevilke[$stevec][] = $podatek;
			$stevec++;
		}else if($podatek !== '') {
			$operator[] = $podatek;
		}
	}
}
$total = 0;
for($i = 0; $i < count($stevilke); $i++) {
	if($operator[$i] == '+') {
		$total+= array_sum($stevilke[$i]);
	}else {
		$total += array_product($stevilke[$i]);
	}
}
echo 'part 1:'.$total;
