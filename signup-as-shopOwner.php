<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

</head>
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

    $password = $_POST["shopOwnerPWD"];

    if($password != $_POST["shopOwnerCPWD"]){
      $error +=1;
      $conPassError = "Password not match";
    }

    $stl = $_POST["shopOwnerTDN"];

    $latitude = $_POST["shoOwnerLatitude"];

    $longitude = $_POST["shopOwnerLongitude"];

    $address = $_POST["shopOwnerAddress"];
   
    if($error == 0){
      include("Mysqldb.php");
      
      $sql = "insert into shopowner(ShopName,Email,Contact,Password,Latitude,Longitude,Address,ShopTradeLicence,flag) values ('".$name."','".$email."','".$phone."','".$password."','".$latitude."','".$longitude."','".$address."','".$stl."',2);";

      $sql .= "insert into carshop(Email,Password,flag) values ('".$email."','".$password."',2);";

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

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-primary">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Enter Your information</h3>
                    </div>
                    <div class="panel-body">
                          <form class="form-horizontal" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "Post">

                             <div class="form-group">
                                <label class="control-label col-sm-2" for="shpName">Shop Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="shpName" name = "shopOwnerName" placeholder="Enter Shop Name" required><span><?php echo $nameError; ?></span>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" id="email" name = "shopOwnerEmail" placeholder="Enter email" required><span><?php echo $emailError; ?></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Contact:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="pwd" name = "shopOwnerPhone" placeholder="Enter Contact Number" required><span><?php echo $phoneError; ?></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" name = "shopOwnerPWD" placeholder="Enter Password" required><span><?php echo $passError; ?></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" name = "shopOwnerCPWD" placeholder="Enter Password Again" required><span><?php echo $conPassError; ?></span>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-2" for="shoptradeLicence">Shop Trade Licence:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="shoptradeLicence" name = "shopOwnerTDN"
                                  placeholder="Enter Shop Trade Licence" required>
                                </div>
                              </div>

                              <hr>
                              <span class="text-center">Location</span>
                              <hr>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="maps-latitude">Google Maps Latitude:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="maps-latitude" name = "shopOwnerLatitude"     placeholder="Enter Google Maps Latitude" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="maps-latitude">Google Maps Longitude:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="maps-longitude" name = "shopOwnerLongitude" placeholder="Enter Google Maps Longitude" required>
                                </div>
                              </div>
                              <hr>
                               <div class="form-group">
                                  <label class="control-label col-sm-2" for="comment">Address:</label>
                                  <div class="col-sm-10">
                                      <textarea class="form-control" id="comment" name = "shopOwnerAddress" required></textarea>
                                  </div>
                                  
                               </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

</body>

</html>
