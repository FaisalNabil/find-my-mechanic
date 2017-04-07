<!DOCTYPE html>
<html>
<?php 
    require("shopOwnerPHP/selectFromDatabase.php"); 

    $jsonShopOwnerString = getJSONFromDB("select * from shopowner");

    $shopOwnerData = json_decode($jsonShopOwnerString);

    $jsonServiceString = getJSONFromDB("select * from availableservices");

    $avilableserviceData = json_decode($jsonServiceString);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
   </head>
<body>
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
                            <a class="text-center" href="message.php">
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        <li><a href="setting.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
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
                                <div>Tuhin Ent.</div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <hr>

                    <li>
                        <a href="index.html"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                    </li>
                    <li>
                        <a href="message.php"><i class="fa fa-comment fa-fw"></i>Messages</a>
                    </li>
                    <li>
                        <a href="notification.html"><i class="fa fa-bell fa-fw"></i>Notification</a>
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
                    <h1 class="page-header">Profile</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="row">
                <h3 class="alert alert-info">About</h3>
                 <div class="col-md-4">
                     <label class="control-label col-sm-2" for="user_name">Name:</label>
                     <span class="col-sm-10"><em><?php echo $shopOwnerData[0]->ShopName; ?></em></span>
                 </div>
                 
                 <div class="col-md-4">
                     <label class="control-label col-sm-2" for="user_name">Contact: </label>
                     <span class="col-sm-9 col-md-offset-1"><em><?php echo $shopOwnerData[0]->Contact; ?></em></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-4" for="user_name">Location: </label>
                     <span class="col-md-6"><em><?php echo $shopOwnerData[0]->Address; ?></em></span>
                 </div>
                 <div class="col-md-4">
                     <label class="control-label col-sm-6" for="user_name">Trade Licence: </label>
                     <span class="col-md-6"><em><?php echo $shopOwnerData[0]->ShopTradeLicence; ?></em></span>
                 </div>
                 <div class="pull-right" style="margin-top: 20px; margin-right: 30px;">
                     <a href="edit_profile.php"><button class="btn btn-info">Edit Details <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                 </div>
            </div>
            <div class="row">
                <h3 class="alert alert-info">Service Details</h3>
                
            </div>
            <div class="row">
                
                <div class="col-lg-12">
                     
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Service 
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                         <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Service Available</th>
                                                <th>Cost</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                for ($i=0;$i<sizeof($avilableserviceData);$i++) {
                                                    # code...
                                                ?>
                                                <tr>
                                                    <td> <?php echo $avilableserviceData[$i]->ServicesId; ?> </td>
                                                    <td> <?php echo $avilableserviceData[$i]->ServiceName; ?> </td>
                                                     <td> <?php echo $avilableserviceData[$i]->Cost; ?> </td>
                                                    <td><button class="btn btn-info" data-toggle="modal" data-target="#edit_service<?php echo $i; ?>">Edit</button>
    <!-- Modal -->
    <div class="modal fade" id="edit_service<?php echo $i; ?>" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Service</h4>
            </div>
            <div class="modal-body">
                  <form class="form-horizontal" method="POST" action="">
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="service_id">Service Id:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="ServiceId" id="service_id" value="<?php echo $avilableserviceData[$i]->ServicesId; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="service_name">Service Name:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="ServiceName" id="service_name" value="<?php echo $avilableserviceData[$i]->ServiceName; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="service_cost">Cost:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="Cost" id="service_cost" value="<?php echo $avilableserviceData[$i]->Cost; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="submit" class="btn btn-primary" value="Submit"></input>
                        </div>
                      </div>
                    </form>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $serviceid=$_POST['ServicesId'];
        $servicename=$_POST['ServicesName'];
        $cost=$_POST['Cost'];

        require ("shopOwnerPHP/updateDatabase.php");

        $result=' ';
        $sql="UPDATE shopowner SET ServiceName='".$servicename."', Cost='".$cost."' WHERE ServiceId='".$serviceid."' ";

        if(updateDB($sql)==1){
            $result='<div class="alert alert-success alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Your Data Update Was Successfull!</strong>
                         </div>';
        }
        else{
            $result='<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Your Data Was Not Updated!</strong>
                         </div>';
        }
    }
?>

                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div><!-- End Modal -->
                                                        <button class="btn btn-danger">Delete</button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                  <?php
                                              }

                                            ?>

                                          </table>
                                          
                                    </div>

                                </div>

                            </div>
                            <!-- row -->
                            <button class="btn btn-warning" data-toggle="modal" data-target="#myModal1">Add Another One</button>
                            <!-- Modal -->
                                                    <div class="modal fade" id="myModal1" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Service Entry</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <form class="form-horizontal">
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="service_name">Service Name:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" id="service_name"  placeholder="Enter Service Name">
                                                                        </div>
                                                                      </div>

                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="service_cost">Cost:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" id="service_cost"  placeholder="Enter Service Cost">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                          <button type="submit" class="btn btn-primary">Submit</button>
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
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!--End simple table example -->
                    <?php echo $result; ?>
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
