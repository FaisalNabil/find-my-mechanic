
<?php 
              
             
             include "TemplateFile/header.php"; 

       ?>
<?php 
//session_start();

//include("phpFiles/SelectProfileData.php"); 

$jsonCarOwnerDataString = getJSONFromDB("select * from carowner where Email='".$_SESSION["carOwnerEmail"]."'");

$carOwnerData = json_decode($jsonCarOwnerDataString);

$jsonCarOwnerVehicleString = getJSONFromDB("select * from vehicle JOIN ownervehiclerelation ON vehicle.VehicleRegNo=ownervehiclerelation.VehicleRegNo WHERE ownervehiclerelation.Email='".$_SESSION["carOwnerEmail"]."'");

$carOwnerVehicleData = json_decode($jsonCarOwnerVehicleString);

$info ="";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'phpFiles/Mysqldb.php';
    include 'phpFiles/updateDatabase.php';


   if (!empty($_POST['vehivle_name']) && !empty($_POST['type']) && !empty($_POST['RegNo']) && !empty($_POST['RegDate']) && !empty($_POST['InsuranceNo']))

    {
      $vehivle_name   = $_POST['vehivle_name'];  
      $type           = $_POST['type'];    
      $RegNo          = $_POST['RegNo'];    
      $RegDate        = $_POST['RegDate'];  
      $InsuranceNo    = $_POST['InsuranceNo'];
      $hiddenRegNo    = $_POST['hiddenRegNo'];
       
    }                                          
       
       $sql = "UPDATE vehicle SET VehicleRegNo ='".$RegNo."',RegistrationDate ='".$RegDate."',InsuranceNumber ='".$InsuranceNo."',VehicleType='".$type."',ModelName='".$vehivle_name."' WHERE VehicleRegNo='".$hiddenRegNo."'";
       
        if(updateDB($sql)==1){
            header("Refresh:0");
             
        }
        else{
            $result='<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Your Data Was Not Updated!</strong>
                         </div>';
        }

}
    if (isset($_POST['delete'])) {

         $hiddenRegNo    = $_POST['hiddenRegNo'];

         include 'phpFiles/Mysqldb.php';
         include 'phpFiles/updateDatabase.php';

        $sql = "DELETE FROM vehicle WHERE VehicleRegNo='".$hiddenRegNo."'";

        if(updateDB($sql)==1){
            header("Refresh:0");
             
        }
        else{
            $result='<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Your Data Was Not Deleted!</strong>
                         </div>';
        }
    }


?>

<script type="text/javascript">

xmlhttp = new XMLHttpRequest();
     

    function RegNoCheck(id,error){   //Checks RegNo
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById(error);
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="*Registration No Already Exist, Try another one";
                m.style.color= "red";
            }
            else{
                m.innerHTML="Valid Registration No!";
                m.style.color= "green";
            }   
                
        }
    };
    var url="phpFiles/RegNoCheckAjax.php?RegNo="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }
</script>

        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">                 
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
                 
            </div>
            <div class="row">
                <h3 class="alert alert-info">About</h3>
                 <div class="col-md-4">
                     <label class="control-label col-sm-2" for="user_name">Name:</label>
                     <!-- <span class="col-sm-10"><em>Faisal Nabil</em></span> -->
                     <span class="col-sm-10"><em><?php echo $carOwnerData[0]->Name ;?></em></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-2" for="user_name">DOB: </label>
                     <span class="col-sm-10"><em><?php echo $carOwnerData[0]->DOB ;?></em></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-2" for="user_name">Contact: </label>
                     <span class="col-sm-9 col-md-offset-1"><em><?php echo $carOwnerData[0]->Contact ;?></em></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-6" for="user_name">Present Address: </label>
                     <span class="col-md-4"><em><?php echo $carOwnerData[0]->Address ;?></em></span>
                 </div>

                 <div class="col-md-4">
                     <label class="control-label col-sm-6" for="nid">National Id: </label>
                     <span class="col-md-4"><?php echo $carOwnerData[0]->NID ;?></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-6" for="dlc">Driving Licence: </label>
                     <span class="col-md-4"><?php echo $carOwnerData[0]->DrivingLicence ;?></span>
                 </div>

                 <div class="pull-right" style="margin-top: 20px; margin-right: 30px;">
                     <a href="edit_profile.php"><button class="btn btn-info">Edit Details <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                 </div>
            </div>   
            <div class="row">
                <h3 class="alert alert-info">Vehicles Details</h3>

                   <?php 
                      echo $info; 
                    ?>
                 <div class="row">
                <div class="col-lg-12">
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa fa-truck fa-fw"></i> Vehicles Details 
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Vehicle Name</th>
													                          <th>Type</th>
                                                    <th>Reg. No</th>
                                                    <th>Date</th>
                                                    <th>Insurance NO</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="rowGenerate">
                                                 <?php 
                                                 $i = 0;
                                                   foreach ($carOwnerVehicleData as $value) {
                                                    $i++;
                                                  ?> 
                                                <tr>
                                                   <td><?php echo $i; ?></td>
                                                   <td><?php echo $value->ModelName; ?></td>
                                                   <td><?php echo $value->VehicleType; ?></td>
                                                   <td><?php echo $value->VehicleRegNo; ?></td>
                                                   <td><?php echo $value->RegistrationDate; ?></td>
                                                   <td><?php echo $value->InsuranceNumber; ?></td>
                                                   <td>
                                                   <button class="btn btn-info" data-toggle="modal" data-target="#edit_service<?php echo $i; ?>">Edit</button> 

                                                  <?php  include "TemplateFile/profileEditServiceModal.php"; ?>                   
                                                  <form action="" method="post" class="vehicleDeleteBtn">
                                                     <input type="hidden" class="form-control" name="hiddenRegNo" id="insoNo" value="<?php echo $value->VehicleRegNo; ?>">
                                                    <button class="btn btn-danger" name="delete" >Delete</button>
                                                  </form>

                                                    </td>
                                                </tr>
                                                <?php 
                                                   }
                                                ?>
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <a href="entry.php"><button class="btn btn-primary">Add Another</button></a>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->
                </div>
            </div>
            </div>
             
             
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
   <?php include 'TemplateFile/footer.php'; ?>