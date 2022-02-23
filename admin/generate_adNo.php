<?php 
include('../config/db.php');
include('../functions.php');
	
$year = date('Y');
$output = genAdno($connection, $year);

echo $output;
	
?>