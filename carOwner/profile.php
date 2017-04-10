<?php 
session_start();

include("phpFiles/SelectProfileData.php"); 

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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
    <link href="../assets/css/jquery.datepick.css" rel="stylesheet" />

</head>
<body >
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
                <a class="navbar-brand logo-color" href="index.html">
                    Logo Goes Here
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger">3</span><i class="fa fa-envelope fa-3x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-danger">Faisal</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>1 minutes ago</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-info">Tuhin</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>5 hours ago</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-success">Sarwar</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="message.html">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-messages -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-warning">2</span>  <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <!-- dropdown Notifications-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="notification.html">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>Help Request Sent Successfully
                                    <span class="pull-right text-muted small"> 1 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="notification.html">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>Tuhin Accept Your Request
                                    <span class="pull-right text-muted small"> 0 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="notification.html">
                                <strong>See All Notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-Notifications -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li onclick="generateData()"><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        <li><a href="setting.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../login.html"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
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
                            <div class="user-section-inner">
                                <img src="../assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div>Faisal <strong>Nabil</strong></div>
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
                        <a href="notification.html"><i class="fa fa-bell fa-fw"></i>Notification</a>
                    </li>
                    <li>
                        <a href="entry.php"><i class="fa fa-edit fa-fw"></i>Entry</a>
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

<!-- Modal -->
<div class="modal fade" id="edit_service<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Vehicle Details</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="vehivle_name">Vehicle Name:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="vehivle_name" value="<?php echo $value->ModelName; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="type">Type:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="type" id="service_name" value="<?php echo $value->VehicleType; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="reg_no">Reg NO. :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="RegNo" id="reg_no<?php echo $i ?>" onkeyup="RegNoCheck('reg_no<?php echo $i; ?>','ErrorMessage<?php echo $i ?>')" value="<?php echo $value->VehicleRegNo;
                         //$_SESSION['VehicleRegNo'] = $value->VehicleRegNo;
                       ?>">
                       <span id="ErrorMessage<?php echo $i ?>"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="reg_date">Reg Date :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="RegDate" id="popupDatepicker" value="<?php echo $value->RegistrationDate; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="insoNo">Insurance NO. :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="InsuranceNo" id="insoNo" value="<?php echo $value->InsuranceNumber; ?>">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="hiddenRegNo" id="insoNo" value="<?php echo $value->VehicleRegNo; ?>">

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="update" class="btn btn-primary" value="Submit"></input>
                    </div>
                  </div>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Modal -->                    
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

    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/jquery.plugin.min.js"></script>
    <script src="../assets/plugins/jquery.datepick.js"></script>
    <script src="../assets/js/custom.js"></script>
     
</body>

</html>
