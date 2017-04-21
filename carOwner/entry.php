<?php 
session_start();

$info = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'phpFiles/Mysqldb.php';

   if (!empty($_POST['VehicleType']) && !empty($_POST['ModelName']) && !empty($_POST['RegNo']) && !empty($_POST['RegDate']) && !empty($_POST['InsuranceNo']))

    {
      $VehicleType = $_POST['VehicleType'];  
      $ModelName   = $_POST['ModelName'];    
      $RegNo       = $_POST['RegNo'];    
      $RegDate     = $_POST['RegDate'];  
      $InsuranceNo = $_POST['InsuranceNo'];   
    }

       $sql = "insert into vehicle values('$RegNo','$RegDate','$InsuranceNo','$VehicleType','$ModelName')"; 
       
       $sqlRel="INSERT INTO ownervehiclerelation VALUES('".$_SESSION["carOwnerEmail"]."','".$RegNo."')";

       //echo $sqlRel;

        if (mysqli_query($conn, $sql)) {
            if(mysqli_query($conn, $sqlRel)){
                $info = 
            '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> The Value Insertered Successfully.
             </div>';
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

}



?>
       <?php 
             $currentPage = 'entry';
             
             include "TemplateFile/header.php"; 

       ?>

        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Entry</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $info; ?>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Registration Information  
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form class="form-horizontal" action="" method="post">
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="vehicle_type">Vehicle Type:</label>
                                          <div class="col-sm-5">
                                            <select name="VehicleType">
                                              <option value="Micro Bus">Micro Bus</option>
                                              <option value="Truck">Truck</option>
                                              <option value="CNG">CNG</option>
                                              <option value="Motor Cycle">Motor Cycle</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="model_name">Model Name:</label>
                                          <div class="col-sm-5">          
                                            <input type="text" class="form-control" id="model_name" name="ModelName" placeholder="Enter Model Name" required="true">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="reg_no">Registration No:</label>
                                          <div class="col-sm-5">
                                             <input type="text" class="form-control" id="reg_no" name="RegNo" placeholder="Enter Registration No" required="true">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="reg_date">Registration Date:</label>
                                          <div class="col-sm-5">          
                                            <input type="text" class="form-control" id="popupDatepicker" name="RegDate" placeholder="Select Registration Date" required="true">
                                          </div> 
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="insurance_no">Insurance Number:</label>
                                          <div class="col-sm-5">          
                                            <input type="text" class="form-control" id="insurance_no" name="InsuranceNo" placeholder="Enter Insurance Number" required="true">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                            <a href="#">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                            </a>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="profile.php">
                                      <button type="submit" class="btn btn-danger">Cancle</button>
                                    </a>
                                </div>

                            </div>
                            <!-- row -->
                        </div>
                        <!-- panel-body -->
                    </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
 <?php include 'TemplateFile/footer.php'; ?>
