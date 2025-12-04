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
	$premiki = [
		//gor
		[-1, 0], 
		//dol
		[1, 0],
		//levo
		[0, -1], 
		//desno
		[0, 1],
		//diagonala gor levo
		[-1,-1], 
		//diagonala gor desno
		[-1,1], 
		//diagonala dol levo
		[1,-1], 
		//diagonala dol desno
		[1,1]
	];
	foreach ($premiki as [$dy, $dx]) {
	    $ny = $y + $dy;
	    $nx = $x + $dx;
	    if ($ny >= 0 && $ny < $maxY && $nx >= 0 && $nx < $maxX -1) {
	        if ($vrstice[$ny][$nx] == "@") {
	        	$np++;
	        }
	    }
	}
	return ($np < 4 ) ? true : false;
}
function menjaj($vrstice) {
	$kopija = $vrstice;
	$skupaj = 0;
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
				$kopija[$i][$j] = '.';
			}
		}
	}
	return array('grid' => $kopija, 'sum' => $skupaj);
}
$skupaj =  $skupaj2 = 0;
//part 1
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
			$kopija[$i][$j] = '.';
		}
	}
}

//part 2
while(true) {
	$grid = menjaj($vrstice);
	if($grid["sum"] == 0) {
		break;
	}
	$vrstice = $grid["grid"];
	$skupaj2 += $grid["sum"];
}
echo 'part 1:'.$skupaj.'<br/>';
echo 'part 2:'.$skupaj2;

//VISUALIZATION
$mreza = implode('', $vrstice);
echo '<pre>';
echo $mreza;
echo '</pre>';
?>
