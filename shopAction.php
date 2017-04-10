<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(empty($_POST["shopOwnerName"])){
			$nameError = "Name is required";
		}else{
			$name = $_POST["shopOwnerName"];
		}

		$email = $_POST["shopOwnerEmail"];

		if(empty($_POST["shopOwnerPhone"])){
			$phoneError = "Phone is required";
		}else{
			$phone = $_POST["shopOwnerPhone"];
		}

		$password = $_POST["shopOwnerPWD"];

		if(empty($_POST["shopOwnerTDN"])){
			$tdnError = "Trade Licence is required";
		}else{
			$stl = $POST["shopOwnerTDN"];
		}

		if(empty($_POST["shoOwnerLatitude"])){
			$latitudeError = "Latitude is required";
		}else{
			$latitude = $_POST["shoOwnerLatitude"];
		}

		if(empty($_POST["shopOwnerLongitude"])){
			$longitudeError = "Longitude is required";
		}else{
			$longitude = $_POST["shopOwnerLongitude"];
		}

		if(empty($_POST["shopOwnerAddress"])){
			$addressError = "Address is required";
		}else{
			$address = $_POST["shopOwnerAddress"];
		}
		

		$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
		if(!$conn){
			die("connection failed: ".mysqli_connect_error());
		}
		$sql = "insert into shopowner(ShopName,Email,Contact,Password,Latitude,Longitude,Address,ShopTradeLicence,flag) values ('".$name."','".$email."','".$phone."','".$password."','".$latitude."','".$longitude."','".$address."','".$stl."',2);";

		$sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',2);";

		if (mysqli_multi_query($conn, $sql)) {
			$_SESSION["shopOwnerSignupEmail"] = $email;
	    	header("Location: shopOwner/index.html");
		}else{
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>