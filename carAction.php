<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = $_POST["carOwnerName"];
		$email = $_POST["carOwnerEmail"];
		$phone = $_POST["carOwnerPhone"];
		$dob = $_POST["carOwnerDOB"];
		$nid = $_POST["carOwnerNID"];
		$drivingLicence = $_POST["carOwnerDriving"];
		$password = $_POST["carOwnerPWD"];
		$address = $_POST["carOwnerAddress"];

		$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
		if(!$conn){
			die("connection failed: ".mysqli_connect_error());
		}
		$sql = "insert into carowner(Name,Email,Contact,DOB,NID,DrivingLicence,Password,Address,flag) values ('".$name."','".$email."','".$phone."','".$dob."','".$nid."','".$drivingLicence."','".$password."','".$address."',1);";

		$sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',1);";

		if (mysqli_multi_query($conn, $sql)) {
	    	header("Location: signup-as-carOwner.php");
		} 
		else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>