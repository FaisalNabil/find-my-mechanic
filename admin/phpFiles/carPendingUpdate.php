<?php
function updateDB($sql){
	
	include 'dbMysql.php';
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}
if($_REQUEST['status']=="active"){
	$sql="UPDATE carowner SET Status='Active' WHERE Email='".$_REQUEST['email']."'";
	$resql="UPDATE carshop SET Status='Active' WHERE Email='".$_REQUEST['email']."'";
	if(updateDB($sql)==1){
		if(updateDB($resql)==1){
			echo "success";
		}
	}
	else
		echo $_REQUEST['email'];
}

else if($_REQUEST['status']=="pending"){
	$sql="UPDATE carowner SET Status='Pending' WHERE Email='".$_REQUEST['email']."'";
	$resql="UPDATE carshop SET Status='Pending' WHERE Email='".$_REQUEST['email']."'";
	if(updateDB($sql)==1){
		if(updateDB($resql)==1){
			echo "success";
		}
	}
	else
		echo $_REQUEST['email'];
}

else if($_REQUEST['status']=="disable"){
	$sql="UPDATE carowner SET Status='Disable' WHERE Email='".$_REQUEST['email']."'";
	$resql="UPDATE carshop SET Status='Disable' WHERE Email='".$_REQUEST['email']."'";
	if(updateDB($sql)==1){
		if(updateDB($resql)==1){
			echo "success";
		}
	}
	else
		echo $_REQUEST['email'];
}

else if($_REQUEST['status']=="remove"){
	$sql="DELETE FROM carowner WHERE Email='".$_REQUEST['email']."'";
	$resql="DELETE FROM carshop WHERE Email='".$_REQUEST['email']."'";
	if(updateDB($sql)==1){
		if(updateDB($resql)==1){
			echo "success";
		}
	}
	else
		echo $_REQUEST['email'];
}

?>