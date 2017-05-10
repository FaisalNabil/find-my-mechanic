<?php
  $nameError = $phoneError = $emailError = $passError = $conPassError = $nidError = "";
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
      if(!preg_match("/^.*(?=.{6,15})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/",$_POST["carOwnerPWD"])){
        $error +=1;
        $passError = "Password must be at least 5 characters and must contain at least one lower case letter, one upper case letter and one digit!";
      }else{
        $password = $_POST["carOwnerPWD"];
      }
    }
  
    if($password != $_POST["carOwnerCPWD"]){
      $error +=1;
      $conPassError = "Password not match";
    }
  
    $dob = $_POST["carOwnerDOB"];

    if(strlen($_POST["carOwnerNid"]) == 13 || strlen($_POST["carOwnerNid"]) == 17){
      $nid = $_POST["carOwnerNid"];
    }else{
      $error +=1;
      $nidError = "Nid must be 13 or 17 characters";
    }

    $drivingLicence = $_POST["carOwnerDriving"];

    $address =  htmlspecialchars(addslashes(trim($_POST["carOwnerAddress"])));
    
    if($error == 0){

      include 'db.php';
        
        $sql = "insert into carowner(Name,Email,Contact,DOB,NID,DrivingLicence,Password,Address,flag,Status) values ('".$name."','".$email."','".$phone."','".$dob."','".$nid."','".$drivingLicence."','".$password."','".$address."',1,'Pending');";

        $sql .= "insert into carshop(Email,Password,flag,status) values ('".$email."','".$password."',1,'Pending');";

        if (mysqli_multi_query($conn, $sql)) {
          //$_SESSION["carOwnerSignupEmail"] = $email;
            header("Location: login.php");
        } 
        else {
            echo mysqli_error($conn);
        }

        mysqli_close($conn);
    }
  }

?>