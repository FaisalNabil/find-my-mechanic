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
$jsonShopOwnerString=getJSONFromDB("SELECT Email FROM shopowner WHERE Email='".$_REQUEST['email']."'");

$shopOwnerDetailData = json_decode($jsonShopOwnerString);

echo $shopOwnerDetailData[0]->Email;
?>