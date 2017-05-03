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
$jsonNidString=getJSONFromDB("SELECT NID FROM carowner WHERE NID='".$_REQUEST['nid']."'");

$jsonNidData = json_decode($jsonNidString);

echo $jsonNidData[0]->NID;

?>