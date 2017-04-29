<?php 
if(isset($_POST['Send']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $email=$_POST['Email'];
  $message=$_POST['Message'];

  function updateDB($sql){
  
    include("db.php");
    
    $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
    
    return $result;
  }
  $sql="INSERT INTO message(ReceiverMail, SenderMail, MessageBody, Date, Status) VALUES ('nabil@admin.com','".$email."','".$message."','".date("Y-m-d")."','unread')";
  //echo $sql;
  if(updateDB($sql)==1){
    $info=
          '<div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Message sent successfully. We will reply as soon as possible.
                        <strong>Thank You for contacting us</strong>
                     </div>';
  }
  else{
    $info=
          '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>There was an error!</strong>
                        Please Try after sometimes
                     </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head <?php $info="";?> >

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
                    
</style>
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
        <li><a href="#service">SERVICE</a></li>
        <li><a href="#team">TEAM</a></li>
        <li><a href="#support">SUPPORT</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span> Sign Up<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="signup-as-carOwner.php" style="color: black;">SignUp <small>as</small> CarOwner</a></li>
            <li><a href="signup-as-shopOwner.php">SignUp <small>as</small> ShopOwner</a></li>
          </ul>
        </li>
        <li><a href="login.php"><span class="fa fa-user"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid bg-grey text-center" id="service" style="margin-top: 20px;">
  <h1 class="section-title text-center page-title">Service</h1>
  <div class="row">
      <div class="col-md-4">
         <span>Loream Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>
      </div>
      <div class="col-md-8">
          <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d116763.77159152745!2d90.4152231!3d23.8588255!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1491329757698" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
  </div>
</div>

<div id="team" class="container-fluid text-center">
    <h1 class="section-title text-center page-title">Meet our team</h1>
      <p class="section-description text-center">We are a small team with great skills. See the faces behind the lines of code. </p>  
      <div class="row member-content">

        <div class="col-sm-4 member-thumb">
          <img class="img-responsive img-center img-thumbnail img-circle" src="assets/img/faisal.jpg" alt="">
          <h4>Faisal Nabil</h4>
          <p class="title">Team Leader & Developer</p>
        </div>

        <div class="col-sm-4 member-thumb">
          <img class="img-responsive img-center img-thumbnail img-circle" src="assets/img/tuhin.jpg" alt="">
          <h4>Safaet Hossain Tuhin</h4>
          <p class="title">Developer</p>
        </div>

        <div class="col-sm-4 member-thumb">
          <img class="img-responsive img-center img-thumbnail img-circle" src="assets/img/sarwar.jpg" alt="">
          <h4>Sarwar Hosen</h4>
          <p class="title">Developer</p>
        </div>
      </div>
  </div>

<div id="support" class="container-fluid bg-grey">
  <h2 class="text-center">SUPPORT</h2>
      <div class="row">
        <div class="col-md-5 col-md-offset-4">
          <form action="" method="post">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="Email">
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <input type="text" name="Message" class="form-control" rows="5" id="message">
            </div>
            <button type="submit" class="btn btn-primary" name="Send">Send</button>
            <?php echo $info; ?>
          </form>
        </div>
      </div>
</div>

<footer class="container-fluid text-center">
  <p>CopyWrite-2017 by <a href="https://findmymechanic.com">FindMyMechanic Team</a></p>
</footer>

</body>
</html>
