<?php
function updateDB($sql){
	
	$conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}
$sql="DELETE FROM availableservices WHERE ServicesId='".$_REQUEST['sid']."'";
	//echo $sql;
	if(updateDB($sql)==1)
		echo 1;
	else
		echo 0;
?>