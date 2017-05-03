<?php
function getJSONFromDB($sql){
	
	include 'Mysqldb.php';

	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

	$arr=array();
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
$jsonDlcString=getJSONFromDB("SELECT DrivingLicence FROM carowner WHERE DrivingLicence='".$_REQUEST['Licence']."'");

$jsonDlcData = json_decode($jsonDlcString);

echo $jsonDlcData[0]->DrivingLicence;

?>