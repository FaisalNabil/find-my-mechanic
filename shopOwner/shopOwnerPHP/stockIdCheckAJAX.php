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
$jsonStockString=getJSONFromDB("SELECT * FROM stock WHERE StockId='".$_REQUEST['sid']."'");

$stockDetailData = json_decode($jsonStockString);

echo $stockDetailData[0]->StockId;
?>