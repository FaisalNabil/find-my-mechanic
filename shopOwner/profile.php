<?php 
  $info="";
  include("TemplateFile/header.php"); 
?>
<?php 

    $jsonShopOwnerString = getJSONFromDB("SELECT * FROM shopowner WHERE Email= '".$_SESSION["shopOwnerEmail"]."'");
    //echo $_SESSION["shopOwnerEmail"];
    $shopOwnerData = json_decode($jsonShopOwnerString);

    $jsonServiceString = getJSONFromDB("SELECT * FROM availableservices JOIN shopservicerelation ON availableservices.ServicesId=shopservicerelation.ServicesId WHERE shopservicerelation.ShopEmail= '".$_SESSION["shopOwnerEmail"]."'");

    $avilableserviceData = json_decode($jsonServiceString);

    if(isset($_POST['editSubmit']) && $_POST['ServiceName']!="" && $_POST['Cost']!="" && $_SERVER["REQUEST_METHOD"] == "POST"){
        //$serviceid=$_POST['ServiceId'];
        $servicename=$_POST['ServiceName'];
        $cost=$_POST['Cost'];
        $serviceidhidden=$_POST['ServiceIdHidden'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="UPDATE availableservices SET ServiceName='".$servicename."', Cost='".$cost."' WHERE ServicesId='".$serviceidhidden."' ";
        //echo $sql;
        if(updateDB($sql)==1){
            //echo "<script type='text/javascript'>alert('Successfully updated');</script>";
            header("Refresh:0");
            
        }
        else{
            $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Data Updating <strong>Failed!</strong>
                     </div>';
        }
        
    }
    else if(isset($_POST['editSubmit'])) {
        $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Please Fill All Data</strong>
                     </div>';
    }

    if(isset($_POST['addanothersubmit']) && $_POST['Addservicename']!="" && $_POST['Addservicecost']!="" && $_SERVER["REQUEST_METHOD"] == "POST"){
        $addserviceid=date("md")+time();
        $addservicename=$_POST['Addservicename'];
        $addcost=$_POST['Addservicecost'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="INSERT INTO availableservices (ServicesId, ServiceName, Cost) VALUES ('".$addserviceid."', '".$addservicename."','".$addcost."')";

        $sqlRelation="INSERT INTO shopservicerelation (ServicesId, ShopEmail) VALUES('".$addserviceid."','".$_SESSION["shopOwnerEmail"]."')";
        echo $sqlRelation;
        if(updateDB($sql)==1){
            //echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
            updateDB($sqlRelation);
            header("Refresh:0");
        }
        else{
            $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Adding!</strong> Failed.
                     </div>';
        }
        
    }else if(isset($_POST['addanothersubmit'])) {
        $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Please Fill All Data</strong>
                     </div>';
    }
?>

<script type="text/javascript">
xmlhttp = new XMLHttpRequest();
    function deletefunction(obj,id){ //Delete operation
        //alert(id);
        //str=document.getElementById(id).innerText;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            //m=document.getElementById(id);
            var i=xmlhttp.responseText;
            if(i==1)
                document.getElementById("serviceTable").deleteRow(obj.parentNode.parentNode.rowIndex);
        }
    };
    var url="shopOwnerPHP/serviceRowDelete.php?sid="+id;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }

</script>

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
                <?php echo $info; ?>
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
                                                    <td id="serviceid<?php echo $i ?>"> <?php echo $i+1; ?> </td>
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
                                                                          <!-- <div class="form-group">
                                                                            <label class="control-label col-sm-2" for="service_id">Service Id:</label>
                                                                            <div class="col-sm-5">
                                                                              <input type="text" class="form-control" name="ServiceId" id="service_id<?php echo $i ?>" value="<?php echo $avilableserviceData[$i]->ServicesId; ?>" onkeyup="serviceIdCheck('service_id<?php echo $i; ?>')"><span id="errorMessage"></span>
                                                                            </div>
                                                                          </div> -->
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
                                                            
                                                        <button class="btn btn-danger" onclick="deletefunction(this,'<?php echo $avilableserviceData[$i]->ServicesId; ?>')">Delete</button>
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
                            <button class="btn btn-warning" data-toggle="modal" data-target="#addAnotherModal">Add Another One</button>
                            <!-- Modal -->
                                                    <div class="modal fade" id="addAnotherModal" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Service Entry</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <form class="form-horizontal" method="POST" action="">
                                                                      <!-- <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_service_id">Service Id:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="Addserviceid" id="add_service_id" onkeyup="serviceIdCheckOnAdd('add_service_id')" placeholder="Enter Service Id">
                                                                        </div><span id="addErrorMessage"></span>
                                                                      </div>
 -->
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
                </div>   
            </div>
             
        </div>
        <!-- end page-wrapper -->
<?php include("TemplateFile/footer.php"); ?>
