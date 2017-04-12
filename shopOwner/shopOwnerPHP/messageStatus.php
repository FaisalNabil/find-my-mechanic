<?php session_start();
function updateDB($sql){
	
	$conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}

$sql="UPDATE message SET Status='read' WHERE SenderMail='".$_REQUEST['sender']."' AND ReceiverMail='".$_SESSION['shopOwnerEmail']."'";

if(updateDB($sql)>0)
	echo "success";
else
	echo "failed";

?>