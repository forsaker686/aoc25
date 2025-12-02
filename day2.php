<?php
$vnos = fopen("day2.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day2.txt"));
fclose($vnos);
$podatki = trim($podatki);
$ids = preg_split("/,/", $podatki);
$numbers = $numbers2 =  [];
foreach($ids as $id) {
	[$x, $y] = explode('-', $id);
	for($i = $x; $i <= $y; $i++) {
		$st = strval($i);
		if(strlen($st) >=2) {
		    if (preg_match('/^(\d+)\1+$/', $st)) {
	            $numbers2[] = $i;
	        }
			$half = ceil(strlen($st)/2);
			if($half % 2 == 0 || $half % 3 == 0 || $half % 4 == 0 || $half % 5 == 0 || $half % 6 == 0) {
				if(substr($st, 0, $half) == substr($st, $half)) {
					$numbers[] = $i;
				}
			}
			if(strlen($st) == 2) {
				if($st[0] == $st[1]) {
					$numbers[] = $i;
				}
			}
		}
	}
}
echo 'part 1:'.(array_sum($numbers));
echo 'part 2:'.(array_sum($numbers2));
