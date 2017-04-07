<?php session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$email = $_POST["email"];
		$password = $_POST["password"];

	function getJSONFromDB($sql){
		$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
		$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
		$arr=array();
		while($row = mysqli_fetch_assoc($result)) {
			$arr[]=$row;
		}
		return json_encode($arr);
	}

	$sql="select password,flag from carshop where email = '".$email."'";
	$jsonData= getJSONFromDB($sql);
	$json=json_decode($jsonData);
	//echo $json[0]->flag;
	if($json[0]->flag == '2' && $json[0]->password == $password){
		$_SESSION["shopOwnerEmail"] = $email;
		header("Location: shopOwner/index.html");
	}
	elseif($json[0]->flag == '1' && $json[0]->password == $password){
		$_SESSION["carOwnerEmail"] = $email;
		header("Location: carOwner/index.html");
	}
	else{
		//$_SESSION["error"] == "yes";
		header("Location: Login.php"); 
	}
}
?>