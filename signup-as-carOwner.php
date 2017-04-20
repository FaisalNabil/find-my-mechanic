<!DOCTYPE html>
<html lang="en">
<head>

  <title>Find My Mechanic</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="assets/css/jquery.datepick.css" rel="stylesheet" />
  <style>
        
/* ------------------------------- */

 body {
    font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
}


h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  } 

/* Wrappers */

 #wrapper {
    width: 100%;
    margin-top: 55px!important; 
    background-color:#04B173;
    height: 1000px; 
}

#page-wrapper {
    padding: 0 15px;
    min-height: 568px;
     background-color:rgb(209, 212, 216);
}

.left-margin{
    margin-left: 327px;
}

/* Message */
.image-control img{
  width: 30px;
  height: 30px;
  border-radius: 50%;
}
.space{
    margin-bottom: 30px;
}

/* Home Page Navigation Var */
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand{
      color: black !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
 .navbar-nav .dropdown .dropdown-menu{
    color: #f4511e;
 }
.team-wraper{
    border: 1px solid red;
}

.page-title{
    color:#5bc0de;    
}

#support{
    background: #e6eeff;
}
                    
</style>
 <?php
  include("carAction.php");
?>
<script>
  function passwordCheck(str){
    var xhttp;
    cpwd = document.forms[0].elements[6].value;
    pmsg = document.getElementById("ipwd");
    if(cpwd.length < 6){
      pmsg.innerHTML = "minimun 6 char";
    }
    else{
      pmsg.innerHTML = "";
    }
  }
  
  function conPasswordCheck(str){
    cpwd = document.forms[0].elements[6].value;
    conPwd= document.forms[0].elements[7].value;
    con = document.getElementById("conP");
    if(cpwd != conPwd){
      con.innerHTML = "password are not match";
    }
    else{
      con.innerHTML = "";
    }
  }
  
  $(document).ready(function(){
    $("input").focus(function(){
      $(this).css("background-color","#cccccc");
    });
    $("input").blur(function(){
      $(this).css("background-color", "#ffffff");
    });
  });
  
</script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">FindMyMechanic</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav left-margin">
        <li><a href="home-Page.html">SERVICE</a></li>
        <li><a href="home-Page.html">TEAM</a></li>
        <li><a href="home-Page.html">SUPPORT</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span> Sign Up<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="signup-as-carOwner.php" style="color: black;">SignUp As CarOwner</a></li>
            <li><a href="signup-as-shopOwner.php">SignUp As ShopOwner</a></li>
          </ul>
        </li>
        <li><a href="login.php"><span class="fa fa-user"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
       <div class="row" style="margin-top: 60px; margin-bottom: 0px;" >
         <div class="col-md-12 text-center">
            <i class="fa fa-car fa-4x" style="color:red;"></i>
             <span style="color: #3CE956; font-size: 30px;">Sign Up As Car Owner</span> <i class="fa fa-car fa-4x"  style="color:red;"></i>

         </div>
       </div>
       <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-primary">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Enter Your information</h3>
                    </div>
                    <div class="panel-body">
                          <form class="form-horizontal" action = "shopAction.php" method = "Post">

                             <div class="form-group">
                                <label class="control-label col-sm-2" for="Name">Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerName" id="name" placeholder="Enter Name" required>
                                  <span style="color:red"><?php echo $nameError; ?></span> <!--Name Error Show-->
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" name = "carOwnerEmail" id="email" placeholder="Enter email" required>
                                  <span style="color:red"><?php echo $emailError; ?></span> <!--Email Error Show-->
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Contact:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerPhone" id="pwd" placeholder="Enter Contact Number" required="">
                                  <span style="color:red"><?php echo $phoneError; ?></span> <!--phone Error Show-->
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="DOB">DOB:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerDOB" id="popupDatepicker" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="nid">NID:</label>
                                <div class="col-sm-10">
                                  <input type="number" class="form-control" id="nid" name = "carOwnerNid" placeholder="Enter NID Number" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="dlc">Driving Licence:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="dlc" name = "carOwnerDriving" placeholder="Enter Driving Licence" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" onkeyup = "passwordCheck(carOwnerPWD)" name = "carOwnerPWD" placeholder="Enter Password" required>
                                  <span id = "ipwd" style="color:red"><?php echo $passError; ?></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" onkeyup = "conPasswordCheck(carOwnerCPWD)" name = "carOwnerCPWD" placeholder="Enter Password Again" required>
                                  <span id = "conP" style="color:red"><?php echo $conPassError; ?></span>
                                </div>
                              </div>
                               <div class="form-group">
                                  <label class="control-label col-sm-2" for="comment">Address:</label>
                                  <div class="col-sm-10">
                                      <textarea class="form-control" id="comment" name = "carOwnerAddress" required=""></textarea>
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

<footer class="container-fluid text-center" style="background-color: #e4f2d8;">
  <p>CopyWrite-2017 by <a href="https://findmymechanic.com">FindMyMechanic Team</a></p>
</footer>

    <script src="assets/plugins/jquery-1.12.0.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery.plugin.min.js"></script>
    <script src="assets/plugins/jquery.datepick.js"></script>
    <script>
    $(function() {
        $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
        $('#inlineDatepicker').datepick({onSelect: showDate});
    });
    </script>

</body>
</html>
