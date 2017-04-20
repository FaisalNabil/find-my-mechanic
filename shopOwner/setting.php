<?php include("TemplateFile/header.php"); ?>
<?php

   require("shopOwnerPHP/updateDatabase.php");

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
              
                    $sql = "UPDATE shopowner SET Password ='".$newPassowrd."' WHERE Email='".$_SESSION["shopOwnerEmail"]."'"; 
                    $resql="UPDATE carshop SET Password ='".$newPassowrd."' WHERE Email='".$_SESSION["shopOwnerEmail"]."'";
                    if (updateDB($sql)==1) {
                      updateDB($resql);
                      
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

<script type="text/javascript">
  function validate(){
    var password=document.getElementById("newPassword").value;
    var repassword=document.getElementById("reNewPassword").value;
    var m=document.getElementById("matchCheck");

    if(password!=repassword){
      m.innerHTML="Password didn't match";
      m.style.color="red";
    }
    else{
      m.innerHTML="Password matches";
      m.style.color="green";
    }
  }
</script>

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
                        <?php //echo $successes; ?>
                    </div>
               </div>
               <div class="cow">
                    <div class="col-lg-12">
                        <?php //echo $error; ?>
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
                                              <input type="password" class="form-control" id="oldPassword" name="OldPassword" placeholder="Enter Old Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="NewPassword">New Password:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" id="newPassword" name="NewPassword" placeholder="Enter New Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-sm-2" for="ConfirmPassword">New Password Again:</label>
                                            <div class="col-sm-5">
                                              <input type="password" class="form-control" id="reNewPassword" name="ConfirmPassword" placeholder="Enter New Password Again" onkeyup="validate()"><span id="matchCheck"></span>
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
<?php include 'TemplateFile/footer.php'; ?>
