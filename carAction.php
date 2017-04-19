<?php
  $nameError = $phoneError = $emailError = $passError = $conPassError = "";
  $error = 0;
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(!preg_match("/^[a-zA-Z ]*$/", $_POST["carOwnerName"])){
      $error = 1;
      $nameError = "Only letters and space are allowed";
    }else{
      $name = $_POST["carOwnerName"];
    }

    if (!filter_var($_POST["carOwnerEmail"], FILTER_VALIDATE_EMAIL)){
      $error +=1;
      $emailError = "Invalid email format";
    }else{
      $email = $_POST["carOwnerEmail"];
    }

    if(!preg_match("/^[0-9]*$/",$_POST["carOwnerPhone"])){
      $error += 1;
      $phoneError = "only numbers are allowed";
    }else{
      $phone = $_POST["carOwnerPhone"];
    }
  
    if(strlen($_POST["carOwnerPWD"]) < 6){
    $error += 1;
    $passError = "minimum 6 charter";
    }else{
    $password = $_POST["carOwnerPWD"];
    }
  
    if($password != $_POST["carOwnerCPWD"]){
      $error +=1;
      $conPassError = "Password not match";
    }
  
    $dob = $_POST["carOwnerDOB"];

    $nid = $_POST["carOwnerNid"];

    $drivingLicence = $_POST["carOwnerDriving"];

    $address =  htmlspecialchars(addslashes(trim($_POST["carOwnerAddress"])));
    
    if($error == 0){
    $conn = mysqli_connect("localhost", "root", "", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }
      
      $sql = "insert into carowner(Name,Email,Contact,DOB,NID,DrivingLicence,Password,Address,flag) values ('".$name."','".$email."','".$phone."','".$dob."','".$nid."','".$drivingLicence."','".$password."','".$address."',1,'pending');";

      $sql .= "insert into carshop(Email,Password,flag,status) values ('".$email."','".$password."',1,'pending');";

      if (mysqli_multi_query($conn, $sql)) {
        $_SESSION["carOwnerSignupEmail"] = $email;
          header("Location: carOwner/index.php");
      } 
      else {
          echo mysqli_error($conn);
      }

      mysqli_close($conn);

    }
  }

?>