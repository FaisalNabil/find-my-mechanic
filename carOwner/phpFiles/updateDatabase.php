<?php 

function updateDB($sql){
	
	include 'Mysqldb.php';
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

?>