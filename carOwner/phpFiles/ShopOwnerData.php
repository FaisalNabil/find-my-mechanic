<?php session_start();
function selectDB($sql){
	
	include 'Mysqldb.php';
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error());
	$arr=array();
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}

$sql="SELECT * FROM shopowner WHERE Email='".$_REQUEST['email']."' ";

echo selectDB($sql);

?>