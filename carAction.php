<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["carOwnerName"])){
			$nameError = "Name is required";
		}else{
			$name = $_POST["carOwnerName"];
		}

		$email = $_POST["carOwnerEmail"];

		if(empty($_POST["carOwnerPhone"])){
			$phoneError = "Phone is required";
		}else{
			$phone = $_POST["carOwnerPhone"];
		}

		if(empty($_POST["carOwnerDOB"])){
			$dobError = $_POST["DOB is required"];
		}else{
			$dob = $_POST["carOwnerDOB"];
		}

		if(empty($_POST["carOwnerNid"])){
			$nidError = "Nid is required";
		}else{
			$nid = $_POST["carOwnerNid"];
		}

		if(empty($_POST["carOwnerDriving"])){
			$dlError = "Driving Licence is required";
		}else{
			$drivingLicence = $_POST["carOwnerDriving"];	
		}

		$password = $_POST["carOwnerPWD"];

		if(empty($_POST["carOwnerAddress"])){
			$addressError = "Address is required";
		}else{
			$address = $_POST["carOwnerAddress"];
		}

		$conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
		if(!$conn){
			die("connection failed: ".mysqli_connect_error());
		}
		$sql = "insert into carowner(Name,Email,Contact,DOB,NID,DrivingLicence,Password,Address,flag) values ('".$name."','".$email."','".$phone."','".$dob."','".$nid."','".$drivingLicence."','".$password."','".$address."',1);";

		$sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',1);";

		if (mysqli_multi_query($conn, $sql)) {
			$_SESSION["carOwnerSignupEmail"] = $email;
	    	header("Location: carOwner/index.php");
		} 
		else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>