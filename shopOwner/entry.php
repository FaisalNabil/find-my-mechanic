<!DOCTYPE html>
<html>
<?php 
    require("shopOwnerPHP/selectFromDatabase.php"); 

    $jsonShopOwnerString = getJSONFromDB("select * from stock");

    $stockDetailData = json_decode($jsonShopOwnerString);

    if(isset($_POST['editSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $stockid=$_POST['PartsId'];
        $stockname=$_POST['PartsName'];
        $unitprice=$_POST['UnitPrice'];
        $totalunit=$_POST['TotalUnit'];
        $hiddenpartsid=$_POST['HiddenPartsId'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="UPDATE stock SET StockId='".$stockid."', PartsName ='".$stockname."', PricePerUnit ='".$unitprice."', TotalUnit ='".$totalunit."' ";
        $sqlRelation="UPDATE shopstockrelation SET StockId='".$stockid."' WHERE ShopEmail='hosensarwar007@gmail.com'";

        //echo $sql;
        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else {
            header("Refresh:0");
        }
    }
    if(isset($_POST['addanothersubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $addstockid=$_POST['AddPartsId'];
        $addstockname=$_POST['AddPartsName'];
        $addtotalunit=$_POST['AddTotalUnit'];
        $addunitprice=$_POST['AddUnitPrice'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="INSERT INTO stock (StockId, PartsName, PricePerUnit, TotalUnit) VALUES ('".$addstockid."','".$addstockname."','".$addunitprice."','".$addtotalunit."')";

        $sqlRelation="INSERT INTO shopstockrelation (StockId, ShopEmail) VALUES('".$addstockid."','hosensarwar007@gmail.com')";
        
        //echo $sql."<br>";
        //echo $sqlRelation;

        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else{
            header("Refresh:0");
        }
        
    }
?>

<script type="text/javascript">
xmlhttp = new XMLHttpRequest();
    function deletefunction(obj,id){
        //alert(id);
        str=document.getElementById(id).innerText;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            //m=document.getElementById(id);
            var i=xmlhttp.responseText;
            if(i==1){
                document.getElementById("stockTable").deleteRow(obj.parentNode.parentNode.rowIndex);
            }
                //m.innerHTML=i;
                
        }
    };
    var url="shopOwnerPHP/stockRowDelete.php?sid="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }

    function partNameCheck(id){
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            m=document.getElementById("errorMessage");
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="Stock Id exist, Try another one";
                m.innerHTML.color='red';
            }
            else{
                m.innerHTML="Good Choice!!";
                m.innerHTML.color='green';
            }   
                
        }
    };
    var url="shopOwnerPHP/stockIdCheckAJAX.php?";
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
                            <a href="message.html">
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
                            <a href="#">
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
                            <a href="#">
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
                            <a class="text-center" href="#">
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
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>User Profile</a>
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
                    <li class="selected">
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
                    <h1 class="page-header">Entry</h1>
                </div>
                 <div class="col-lg-12">
                    <h3 class="alert alert-info">Stock Details</h3>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-truck fa-fw"></i> Stock  
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                         <table class="table table-bordered" id="stockTable">
                                            <thead>
                                              <tr>
                                                <th>Stock Id</th>
                                                <th>Parts Name</th>
                                                <th>Unit Price</th>
                                                <th>Total Unit Left</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                for($i=0;$i<sizeof($stockDetailData);$i++){
                                               ?>     
                                              <tr>
                                                <td id="stockid<?php echo $i ?>"><?php echo $stockDetailData[$i]->StockId; ?></td>
                                                <td><?php echo $stockDetailData[$i]->PartsName; ?></td>
                                                <td><?php echo $stockDetailData[$i]->PricePerUnit; ?></td>
                                                <td><?php echo $stockDetailData[$i]->TotalUnit; ?></td>
                                                <td><button class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Edit</button> 
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Edit Stock</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <form class="form-horizontal" method="POST" action="">
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="parts_id">Parts Id:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="PartsId" id="parts_id<?php echo $i ?>" value="<?php echo $stockDetailData[$i]->StockId; ?>" onkeyup="partNameCheck('parts_id<?php echo $i; ?>')"><span id="errorMessage"></span>
                                                                        </div>
                                                                      </div>

                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="parts_name">Parts Name:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="PartsName" id="parts_name" value="<?php echo $stockDetailData[$i]->PartsName; ?>">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="Unit_price">Unit Price:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="UnitPrice" id="Unit_price" value="<?php echo $stockDetailData[$i]->PricePerUnit; ?>">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="Unit">Total Unit Left:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="TotalUnit" id="Unit" value="<?php echo $stockDetailData[$i]->TotalUnit; ?>">
                                                                        </div>
                                                                      </div>

                                                                          <input type="hidden" class="form-control" name="HiddenPartsId" id="hidden_parts_id" value="<?php echo $stockDetailData[$i]->StockId; ?>">
                                                                        

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
                                                    <button class="btn btn-danger" onclick="deletefunction(this,'stockid<?php echo $i;?>') ">Delete</button>
                                                </td>
                                              </tr>
                                              <?php
                                                    }
                                              ?>
                                            </tbody>
                                          </table>
                                          
                                    </div>

                                </div>

                            </div>
                            <!-- row -->
                            <button class="btn btn-warning" data-toggle="modal" data-target="#myModal2">Add Another One</button>
                            <div class="modal fade" id="myModal2" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Stock Entry</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <form class="form-horizontal" method="POST" action="">
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_parts_id">Parts Id:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="AddPartsId" id="add_parts_id"  placeholder="Enter Parts Id">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_parts_name">Parts Name:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="AddPartsName" id="add_parts_name"  placeholder="Enter Parts Name">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_unit_price">Unit Price:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="AddUnitPrice" id="add_unit_price"  placeholder="Enter Unit Price">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label class="control-label col-sm-2" for="add_total_unit">Total Units:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="AddTotalUnit" id="add_total_unit"  placeholder="Enter Total Unit">
                                                                        </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                          <input type="submit" class="btn btn-primary" name ="addanothersubmit" value="Submit"></input>
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

                     
                </div>
                <!--End Page Header -->
            </div>
            <div class="row">
                  
                 
                 
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>

</body>

</html>
