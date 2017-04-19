<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <style>
        #lcolor{
            color :red;
        }
    </style>
</head>
<?php
    include("ActionLogin.php");
?>
<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 100px;">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action = "" method = "Post">
                             
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value = "<?php echo $email; ?>" required>
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

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

</body>

</html>
