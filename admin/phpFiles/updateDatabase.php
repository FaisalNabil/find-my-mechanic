<?php
function updateDB($sql){
	
	include("dbMysql.php");
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

?>