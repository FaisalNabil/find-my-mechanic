<?php
function getJSONFromDB($sql){
	
	$conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }

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