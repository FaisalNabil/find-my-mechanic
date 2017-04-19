<!DOCTYPE html>
<html lang="en">
<head>

  <title>Find My Mechanic</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

#lcolor{
    color :red;
    }
                    
</style>
</head>

<?php
    include("ActionLogin.php");
?>

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
            <i class="fa fa-sign-in fa-4x" style="color:red;"></i>
            <span style="color: #3CE956; font-size: 30px;">Please Enter Email & Password!</span> <i class="fa fa-sign-in fa-4x"  style="color:red;"></i>

         </div>
       </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 11px;">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action = "" method = "Post">
                             
                                <div class="form-group">
                                    <span id = "lcolor"><?php echo $statusError; ?></span>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value = "<?php echo $email; ?>" required>
                                    <span id = "lcolor"><?php echo $emptyData; ?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                                <span id = "lcolor"><?php echo $loginfailed; ?></span>
                                <!--
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <input type="submit" name="" value = "Login" class="btn btn-lg btn-success btn-block">
                                <div class="text-center">
                                    <b>or</b>
                                </div>
                        </form>
                         
                            <div class="row">
                            <div class="col-md-5">
                                <a href="signup-as-carOwner.php" class="btn btn-lg btn-primary">Signup as car Owner</a>
                            </div>
                            <div class="text-center col-md-1">
                                    <i class="fa fa-opera fa-2x"></i>

                            </div>
                            <div class="col-md-6">
                                <a href="signup-as-shopOwner.php" class="btn btn-lg btn-primary">Signup as shop Owner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

<footer class="container-fluid text-center" style="background-color: #e4f2d8;">
  <p>CopyWrite-2017 by <a href="https://findmymechanic.com">FindMyMechanic Team</a></p>
</footer>

</body>
</html>
