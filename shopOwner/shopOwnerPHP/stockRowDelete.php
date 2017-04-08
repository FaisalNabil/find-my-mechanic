<?php
function updateDB($sql){
	
	$conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }
	
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