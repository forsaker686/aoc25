<?php
$vnos = fopen("day9.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day9.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$grid = [];
foreach($vrstice as $vrstica) {
	[$x, $y] = explode(',', $vrstica);
	$grid[] = [trim($x), trim($y)];
}
//VISUALIZATION - TOO HEAVY ON REAL INPUT
// $max = max($grid);
// $max = max($max);
// $map = '';
// for($i=0; $i <= $max; $i++) {
// 	for($j=0; $j <= $max; $j++) {
// 		$map .= '.';
// 	}
// 	$map.= PHP_EOL;
// }
// $map = explode(PHP_EOL, $map);
// $kopija = $map;
// foreach($grid as $g) { // SAMO ZA VIZUALIZACIJO
// 	$kopija[$g[1]][$g[0]] = "#";
// }

$largest = [[0,0], [0,0]];
$povrsinaM = 0;
for($i=0; $i < count($grid);$i++) {
	for ($j = $i+1; $j < count($grid); $j++) {
		$x1 = $grid[$i][0];
		$x2 = $grid[$j][0];
		$y1 = $grid[$i][1];
		$y2 = $grid[$j][1];
		$povrsina = 0;
		if($x1 !== $x2 && $y1 !== $y2) {
			$povrsina = (abs($x1-$x2)+1)*(abs($y1-$y2)+1);
		}
		
		if($povrsinaM < $povrsina) {
			$povrsinaM = $povrsina;
			$largest = [[$x1, $y1], [$x2, $y2]];
		}
	}
}
echo 'part 1: '.$povrsinaM;
