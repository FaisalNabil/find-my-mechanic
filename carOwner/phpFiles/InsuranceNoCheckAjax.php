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
$jsonInsuNoString=getJSONFromDB("SELECT InsuranceNumber FROM vehicle WHERE InsuranceNumber='".$_REQUEST['InsuNo']."'");

$vehiclDetail = json_decode($jsonInsuNoString);

echo $vehiclDetail[0]->InsuranceNumber;

?>