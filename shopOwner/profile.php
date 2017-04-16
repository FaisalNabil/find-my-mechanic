<!DOCTYPE html>
<html>
<?php session_start();
    require("shopOwnerPHP/selectFromDatabase.php"); 

    $jsonShopOwnerString = getJSONFromDB("SELECT * FROM shopowner WHERE Email= '".$_SESSION["shopOwnerEmail"]."'");
    //echo $_SESSION["shopOwnerEmail"];
    $shopOwnerData = json_decode($jsonShopOwnerString);

    $jsonServiceString = getJSONFromDB("SELECT * FROM availableservices JOIN shopservicerelation ON availableservices.ServicesId=shopservicerelation.ServicesId WHERE shopservicerelation.ShopEmail= '".$_SESSION["shopOwnerEmail"]."'");

    $avilableserviceData = json_decode($jsonServiceString);

    if(isset($_POST['editSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $serviceid=$_POST['ServiceId'];
        $servicename=$_POST['ServiceName'];
        $cost=$_POST['Cost'];
        $serviceidhidden=$_POST['ServiceIdHidden'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="UPDATE availableservices SET ServicesId='".$serviceid."', ServiceName='".$servicename."', Cost='".$cost."' WHERE ServicesId='".$serviceidhidden."' ";
        $sqlRelation="UPDATE availableservices SET ServicesId='".$serviceid."' WHERE ShopEmail= '".$_SESSION["shopOwnerEmail"]."' AND ServicesId='".$serviceidhidden."'";

        //echo $sql;
        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else{
            $result='<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>Your Data Was Not Updated!</strong>
                         </div>';
        }
        
    }

    if(isset($_POST['addanothersubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $addserviceid=$_POST['Addserviceid'];
        $addservicename=$_POST['Addservicename'];
        $addcost=$_POST['Addservicecost'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="INSERT INTO availableservices (ServicesId, ServiceName, Cost) VALUES ('".$addserviceid."','".$addservicename."','".$addcost."')";

        $sqlRelation="INSERT INTO shopservicerelation (ServicesId, ShopEmail) VALUES('".$addserviceid."','".$_SESSION["shopOwnerEmail"]."')";
        
        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else{
            $result='<div class="alert alert-danger alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           New Service <strong>Added</strong>
                         </div>';
        }
        
    }

    $jsonShopOwnerString = getJSONFromDB("SELECT ShopName FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."'");

    $jsonShopOwnerData = json_decode($jsonShopOwnerString);
?>

<script type="text/javascript">
xmlhttp = new XMLHttpRequest();
    function deletefunction(obj,id){ //Delete operation
        //alert(id);
        str=document.getElementById(id).innerText;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            m=document.getElementById(id);
            var i=xmlhttp.responseText;
            if(i==1)
                document.getElementById("serviceTable").deleteRow(obj.parentNode.parentNode.rowIndex);
        }
    };
    var url="shopOwnerPHP/serviceRowDelete.php?sid="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }

    function serviceIdCheck(id){   //Checks Service Id
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("errorMessage");
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="*Service Id exist, Try another one";
                m.style.color= "red";
            }
            else{
                m.innerHTML="Good Choice!!";
                m.style.color= "green";
            }   
                
        }
    };
    var url="shopOwnerPHP/serviceIdCheckAJAX.php?sid="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }

    function serviceIdCheckOnAdd(id){   //checks Service id on new add
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("addErrorMessage");
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="*Service Id exist, Try another one";
                m.style.color= "red";
            }
            else{
                m.innerHTML="Good Choice!!";
                m.style.color= "green";
            }   
                
        }
    };
    var url="shopOwnerPHP/serviceIdCheckAJAX.php?sid="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }
</script>
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
    <div id="wrapper" <?php $result=' '; ?> >
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
                                         <table class="table table-bordered" id="serviceTable">
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
                                                    <td id="serviceid<?php echo $i ?>"> <?php echo $avilableserviceData[$i]->ServicesId; ?> </td>
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
                                                                              <input type="text" class="form-control" name="ServiceId" id="service_id<?php echo $i ?>" value="<?php echo $avilableserviceData[$i]->ServicesId; ?>" onkeyup="serviceIdCheck('service_id<?php echo $i; ?>')"><span id="errorMessage"></span>
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
                                                                          <input type="hidden" class="form-control" name="ServiceIdHidden" id="service_id_hidden" value="<?php echo $avilableserviceData[$i]->ServicesId; ?>">
                                                                          
                                                                          <div class="form-group">
                                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                              <input type="submit" class="btn btn-primary" name="editSubmit" value="Submit"></input>
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
                                                            
                                                        <button class="btn btn-danger" onclick="deletefunction(this,'serviceid<?php echo $i; ?>')">Delete</button>
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
                                                                  <form class="form-horizontal" method="POST" action="">
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_service_id">Service Id:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="Addserviceid" id="add_service_id" onkeyup="serviceIdCheckOnAdd('add_service_id')" placeholder="Enter Service Id">
                                                                        </div><span id="addErrorMessage"></span>
                                                                      </div>

                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_service_name">Service Name:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="Addservicename" id="add_service_name"  placeholder="Enter Service Name">
                                                                        </div>
                                                                      </div>

                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_service_cost">Cost:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="Addservicecost" id="add_service_cost"  placeholder="Enter Service Cost">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                          <input type="submit" class="btn btn-primary" name="addanothersubmit" value="Submit"></input>
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
