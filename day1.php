<?php
$vnos = fopen("day1.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day1.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$start = 50;
$stevec = 0;
$stevec2 = 0;
foreach($vrstice as $vrstica) {
	$posebej = 0;
	$smer = substr($vrstica, 0,1);
	$vrednost = substr($vrstica,1);
	$pVrednost = $start;
	if($smer == 'L') {
			$start -= $vrednost;
		while($start < 0) {
			$stevec2++;
			$start += 100;
		}
	}else {
		$start += $vrednost;
		while($start > 99) {
			$stevec2++;
			$start -= 100;
		}
		var_dump($stevec2);
	}
	$pVrednost = $start;
	$stevec2+= $posebej;
	if($start == 0) {
		$stevec++;
	}
}
echo 'part 1: '.$stevec;
echo '<br/>';
echo 'part 2:'.$stevec2; //works for sample, too high for real input
?>
