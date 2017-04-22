<?php
	$nameError = $phoneError = $emailError = $passError = $conPassError = "";
  	$error = 0;
  	if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	    if(!preg_match("/^[a-zA-Z ]*$/", $_POST["shopOwnerName"])){
	      $error = 1;
	      $nameError = "Only letters and space are allowed";
	    }else{
	      $name = $_POST["shopOwnerName"];
	    }

	    if (!filter_var($_POST["shopOwnerEmail"], FILTER_VALIDATE_EMAIL)){
	      $error +=1;
	      $emailError = "Invalid email format";
	    }else{
	      $email = $_POST["shopOwnerEmail"];
	    }

	    if(!preg_match("/^[0-9]*$/",$_POST["shopOwnerPhone"])){
	      $error += 1;
	      $phoneError = "only numbers are allowed";
	    }else{
	      $phone = $_POST["shopOwnerPhone"];
	    }

	    if(strlen($_POST["shopOwnerPWD"]) < 6){
	    $error += 1;
	    $passError = "minimum 6 charter";
	  	}else{
	    	if(!preg_match("/^.*(?=.{6,15})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/",$_POST["shopOwnerPWD"])){
        		$error +=1;
        		$passError = "Password must be at least 5 characters and must contain at least one lower case letter, one upper case letter and one digit!";
      		}else{
        		$password = $_POST["shopOwnerPWD"];
      		}
	  	}

	    if($password != $_POST["shopOwnerCPWD"]){
	      $error += 1;
	      $conPassError = "Password not match";
	    }

	    $stl = $_POST["shopOwnerTDN"];

	    $latitude = $_POST["shoOwnerLatitude"];

	    $longitude = $_POST["shopOwnerLongitude"];

	    $address = htmlspecialchars(addslashes(trim($_POST["shopOwnerAddress"])));;
	  
	    if($error == 0){
		    $conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
		    if (!$conn) {
		            die("Connection failed: " . mysqli_connect_error());
		    }
		    
		    $sql = "insert into shopowner(ShopName,Email,Contact,Password,Latitude,Longitude,Address,ShopTradeLicence,flag,status) values ('".$name."','".$email."','".$phone."','".$password."','".$latitude."','".$longitude."','".$address."','".$stl."',2,'Pending');";

		    $sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',2,'Pending');";

		    if (mysqli_multi_query($conn, $sql)) {
		      $_SESSION["shopOwnerSignupEmail"] = $email;
		      header("Location: shopOwner/index.html");
		    }else{
		      echo mysqli_error($conn);
		    }

		    mysqli_close($conn);
		}
  	}
?>