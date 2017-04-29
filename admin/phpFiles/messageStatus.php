<?php session_start();
function updateDB($sql){
	
	include("dbMysql.php");
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

$sql="UPDATE message SET Status='read' WHERE SenderMail='".$_REQUEST['sender']."' AND ReceiverMail='".$_SESSION['adminEmail']."'";

if(updateDB($sql)>0)
	echo "success";
else
	echo "failed";

?>