<?php
function updateDB($sql){
	
	include("Mysqldb.php");
	
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	
	return $result;
}
$sql="DELETE FROM stock WHERE StockId='".$_REQUEST['sid']."'";
$sqlRelation="DELETE FROM shopstockrelation WHERE StockId='".$_REQUEST['sid']."'";
	if(updateDB($sql)==1){
		updateDB($sqlRelation);
		echo 1;
	}
	else
		echo 0;
?>