<?php
$vnos = fopen("day4.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day4.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
function premikanje($y, $x, $vrstice) {
	$np = 0;
	$maxY = count($vrstice);
	$maxX = strlen($vrstice[0]);
	//gor
	if($y > 0) {
		if($vrstice[$y-1][$x] == "@") {
			$np++;
		}
	}
	//dol
	if($y+1 < $maxY) {
		if($vrstice[$y+1][$x] == "@") {
			$np++;
		}
	}
	//levo
	if($x > 0) {
		if($vrstice[$y][$x-1] == "@") {
			$np++;
		}
	}
	//desno
	if($x+1 < $maxX) {
		if($vrstice[$y][$x+1] == "@") {
			$np++;
		}
	}
	//diagonala levo gor
	if($y > 0 && $x > 0) {
		if($vrstice[$y-1][$x-1] == "@") {
			$np++;
		}
	}
	//diagonala desno gor
	if($y > 0 && $x+1 < $maxX) {
		if($vrstice[$y-1][$x+1] == "@") {
			$np++;
		}
	}
	//diagonala levo dol
	if($y+1 < $maxY && $x > 0) {
		if($vrstice[$y+1][$x-1] == "@") {
			$np++;
		}
	}
	//diagonala desno dol
	if($y+1 < $maxY && $x+1 < $maxX) {
		if($vrstice[$y+1][$x+1] == "@") {
			$np++;
		}
	}

	return ($np < 4 ) ? true : false;
}
$skupaj = 0;
$kopija = $vrstice;
for($i =0; $i < count($vrstice); $i++) {
	for($j=0; $j < strlen($vrstice[$i]); $j++) {
		if($vrstice[$i][$j] == "@") {
			if(premikanje($i, $j, $vrstice)){
				$kopija[$i][$j] = 'X';
			}
		}
	}
}
for($i =0; $i < count($kopija); $i++) {
	for($j=0; $j < strlen($kopija[$i]); $j++) {
		if($kopija[$i][$j] == "X") {
			$skupaj++;
		}
	}
}
echo 'part 1: '.$skupaj;
