<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = $_POST["shopOwnerName"];
		$email = $_POST["shopOwnerEmail"];
		$phone = $_POST["shopOwnerPhone"];
		$password = $_POST["shopOwnerPWD"];
		$stl = $POST["shopOwnerTDN"];
		$latitude = $_POST["shoOwnerLatitude"];
		$longitude = $_POST["shopOwnerLongitude"];
		$address = $_POST["shopOwnerAddress"];

		$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
		if(!$conn){
			die("connection failed: ".mysqli_connect_error());
		}
		$sql = "insert into shopowner(ShopName,Email,Contact,Password,Latitude,Longitude,Address,ShopTradeLicence,flag) values ('".$name."','".$email."','".$phone."','".$password."','".$latitude."','".$longitude."','".$address."','".$stl."',2);";

		$sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',2);";

		if (mysqli_multi_query($conn, $sql)) {
			$_SESSION["shopOwnerSignupEmail"] = $email;
	    	header("Location: shopOwner/index.html");
		} 
		else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>