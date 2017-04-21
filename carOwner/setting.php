<?php 

    include 'TemplateFile/header.php';


$jsonCarOwnerDataString = getJSONFromDB("select Password from carowner where Email='".$_SESSION["carOwnerEmail"]."'");

$carOwnerPassword = json_decode($jsonCarOwnerDataString);

$successes = "";
$error     ="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   include("phpFiles/Mysqldb.php"); 
   $jsonoldPassword = $carOwnerPassword[0]->Password ;

   if (!empty($_POST['oldPassword']) &&($jsonoldPassword == $_POST['oldPassword'])) {

          if (!empty($_POST['newPassowrd']) && !empty($_POST['ConfirmPassword'])&&($_POST["newPassowrd"] == $_POST["ConfirmPassword"])) {
            $newPassowrd     = $_POST['newPassowrd'];
         $ConfirmPassword = $_POST['ConfirmPassword']; 

        if (preg_match("/^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["newPassowrd"]) === 0) {
            $error = 
             '<div class="alert alert-danger alert-dismissable notification">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Worning!</strong> Password must be at least 5 characters and must contain at least one lower case letter, one upper case letter and one digit!.  
             </div>';
        }else{
               
            $sql = "UPDATE carowner SET Password ='".$newPassowrd."' WHERE Email='".$_SESSION["carOwnerEmail"]."'";

            $sqlcarshop = "UPDATE carshop SET Password ='".$newPassowrd."' WHERE Email='".$_SESSION["carOwnerEmail"]."'"; 
                 $flag = 0;
                if (mysqli_query($conn, $sql)) {
                    if (mysqli_query($conn, $sqlcarshop)) {
                         $successes = 
                    '<div class="alert alert-success alert-dismissable notification">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Password Updated Successfully.
                     </div>';
                         
                    }
                    
                }
            }
              
          }
          
    }else{
        $error = 
             '<div class="alert alert-danger alert-dismissable notification">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Worning!</strong> You Entered Wrong password!.  
             </div>';
    }
} 

?>
  
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
                        <?php echo $error; 
                              
                        ?>
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
                                              <input type="password" class="form-control" id="password" name="oldPassword" placeholder="Enter Old Password"> 
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="new-password">New Password:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" name="newPassowrd" placeholder="Enter New Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="old-password">New Password Again:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" name="ConfirmPassword" placeholder="Enter New Password Again">
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

    <?php include 'TemplateFile/footer.php'; ?>
