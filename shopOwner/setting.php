<!DOCTYPE html>

<?php session_start();

   require("shopOwnerPHP/updateDatabase.php");
   require("shopOwnerPHP/selectFromDatabase.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $jsonShopOwnerString = getJSONFromDB("SELECT Password FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."'");

    $passwordData = json_decode($jsonShopOwnerString);


    if($passwordData[0]->Password!=$_POST['OldPassword']){
        $error = 
             '<div class="alert alert-danger alert-dismissable">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Incorrect Password!</strong> Please Input Your Valid Old Password!.  
             </div>';
    }
    else{
       if (!empty($_POST['OldPassword']) && !empty($_POST['NewPassword']) && !empty($_POST['ConfirmPassword']) && ($_POST["NewPassword"] == $_POST["ConfirmPassword"]) && $passwordData[0]->Password==$_POST['OldPassword'] ) {

             $newPassowrd     = $_POST['NewPassword'];
             $confirmPassword = $_POST['ConfirmPassword']; 

            if (preg_match("/^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["NewPassword"]) === 0) {
                $error = 
                 '<div class="alert alert-danger alert-dismissable">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Worning!</strong> Password must be at least 5 characters and must contain at least one lower case letter, one upper case letter and one digit!.  
                 </div>';

            }
            else{
                   $welcome =  "Welcome";
                    $sql = "UPDATE shopowner SET Password ='".$newPassowrd."' WHERE Email='hosensarwar007@gmail.com'"; 

                    if (updateDB($sql)==1) {
                        $successes = 
                        '<div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> Password Updated Successfully.
                         </div>';
                    }
                    else{
                        $error = 
                         '<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Warning!</strong> Password Was Not Updated!  
                         </div>';
                    }
                }
        }
        else{
            $error = 
             '<div class="alert alert-danger alert-dismissable">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Warning!</strong> Please Check, You\'ve Entered Or Confirmed Your Password!  
             </div>';
        } 
        }
    }

    $jsonString = getJSONFromDB("SELECT ShopName FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."' ");

    $jsonShopOwnerData = json_decode($jsonString); 
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
   </head>
<body <?php $successes=$error=' '; ?> >
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo-color" href="index.php">
                    Logo Goes Here
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <?php include("TemplateFile/messageTemplate.php"); ?>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-info">
                                <div><?php echo $jsonShopOwnerData[0]->ShopName; ?></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <hr>

                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                    </li>
                    <li>
                        <a href="message.php"><i class="fa fa-comment fa-fw"></i>Messages</a>
                    </li>
                    <li>
                        <a href="notification.php"><i class="fa fa-bell fa-fw"></i>Notification</a>
                    </li>
                    <li>
                        <a href="entry.php"><i class="fa fa-edit fa-fw"></i>Available Stock</a>
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Settings</h1>
                </div>

                <div class="cow">
                    <div class="col-lg-12">
                         <div class="alert alert-info alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Info!</strong> Password must be at least 5 characters and must contain at least one lower case letter, one upper case letter and one digit!.  
                         </div>
                    </div>
               </div>

                <div class="cow">
                    <div class="col-lg-12">
                        <?php echo $successes; ?>
                    </div>
               </div>
               <div class="cow">
                    <div class="col-lg-12">
                        <?php echo $error; ?>
                    </div>
               </div>
                <!--End Page Header -->
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil-square-o fa-fw"></i> Change Password 
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form class="form-horizontal" action="" method="post">
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="old-password">Old Password:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" id="email" name="OldPassword" placeholder="Enter Old Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="old-password">New Password:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" id="email" name="NewPassword" placeholder="Enter New Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="old-password">New Password Again:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" id="email" name="ConfirmPassword" placeholder="Enter New Password Again">
                                            </div>
                                          </div>
                                           
                                          <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <button type="submit" class="btn btn-info">Change</button>
                                            </div>
                                          </div>
                                      </form>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    
</body>

</html>
