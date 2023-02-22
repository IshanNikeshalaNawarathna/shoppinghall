<?php

header("Content-Type: application/octet-stream");

$file = $_GET["page"];

header("Content-Disposition: attachment; filename=" . urlencode($file));
header("Content-Type: application/download");
header("Content-Description: File Transfer");			
header("Content-Length: " . filesize($file));

flush(); 

$fp = fopen($file, "r");
while (!feof($fp)) {
	echo fread($fp, 65536);
	flush(); 
}

fclose($fp);