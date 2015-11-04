<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://sh.st");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);	
var_dump($result);

$needle1="<title>Redirecting to ";  //22	
$needle2="</title>";  	


$pos1 = strpos($result, $needle1);
$pos1 = $pos1+22;
$pos2 = strpos($result, $needle2);

$blee = substr($result, $pos1,$pos2-$pos1);
// echo $blee . "\n";


?> 