<?php
function getJSONFromDB($sql){
	
	include("Mysqldb.php");

	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$arr=array();
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
$jsonServiceString=getJSONFromDB("SELECT * FROM availableservices WHERE ServicesId='".$_REQUEST['sid']."'");

$serviceDetailData = json_decode($jsonServiceString);

echo $serviceDetailData[0]->ServicesId;
?>