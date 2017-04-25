<?php session_start();
function updateDB($sql){
	
	include("Mysqldb.php");
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

$sql="UPDATE service SET Status='Done' WHERE ServiceId='".$_REQUEST['sid']."' ";

if(updateDB($sql)>0)
	echo "success";
else
	echo "failed";

?>