

<?php 
session_start();

include("phpFiles/SelectProfileData.php"); 

$jsonString = getJSONFromDB("select * from carowner where Email='".$_SESSION["carOwnerEmail"]."'");

$carOwnerData = json_decode($jsonString);

$info ="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'phpFiles/Mysqldb.php';

   if (!empty($_POST['Name']) && !empty($_POST['Birthdate']) && !empty($_POST['contact']) && !empty($_POST['NID']) && !empty($_POST['DrivingLicence']) && !empty($_POST['PresentAddress']))

    {
      $Name           = $_POST['Name'];  
      $Birthdate      = $_POST['Birthdate'];    
      $contact        = $_POST['contact'];    
      $NID            = $_POST['NID'];  
      $DrivingLicence = $_POST['DrivingLicence'];   
      $PresentAddress = $_POST['PresentAddress'];   
    }
       

       $sql = "UPDATE carowner SET Name ='".$Name."',Contact='".$contact."',DOB='".$Birthdate."',NID='".$NID."',DrivingLicence = '".$DrivingLicence."',Address='".$PresentAddress."' WHERE Email='".$_SESSION["carOwnerEmail"]."'"; 

        if (mysqli_query($conn, $sql)) {
            $info = 
            '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> The Value Supdated Successfully.
             </div>';
        } else {
            $info = 
            '<div class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Info!</strong> Updated Failed.
             </div>';
        }

}

?>
        <?php

             
             include "TemplateFile/header.php"; 
        ?>

         <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="cow">
                <div class="col-lg-12">
                    <?php echo $info; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil-square-o fa-fw"></i> Edit Profile  
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                         <form class="form-horizontal" action="" method="post">
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Name:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $carOwnerData[0]->Name ;?>">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="DOB">DOB:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="popupDatepicker" placeholder="Please Select Your Date of Birth" name="Birthdate" value="<?php echo $carOwnerData[0]->DOB ;?>">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Contact:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="contact" placeholder="" name="contact"  value="<?php echo $carOwnerData[0]->Contact ;?>">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="nid">NID:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" name="NID" id="nid" value="<?php echo $carOwnerData[0]->NID ;?>">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="dlc">Driving Liscence:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" name="DrivingLicence" id="dlc" value="<?php echo $carOwnerData[0]->DrivingLicence ;?>">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="address">Present Address:</label>
                                                <div class="col-sm-5">
                                                   <textarea class="form-control" id="comment" name="PresentAddress" required=""><?php echo $carOwnerData[0]->Address ;?></textarea>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-2">
                                                  <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                              </div>
                                         </form>
                                         <div class="col-sm-2">
                                            <a href="profile.php"><button type="submit" class="btn btn-danger">Cancle</button></a>
                                         </div>
                                          
                                    </div>

                                </div>

                            </div>
                            <!-- row -->
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!--End simple table example -->
                </div>  
            </div>
            
             
             
        </div>
        <!-- end page-wrapper -->
        
    <?php include 'TemplateFile/footer.php'; ?>
