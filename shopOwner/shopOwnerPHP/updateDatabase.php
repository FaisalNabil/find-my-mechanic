<?php
function updateDB($sql){
	$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

?>