<?php include("TemplateFile/header.php"); ?>
<?php 

    $jsonShopOwnerString = getJSONFromDB("select * from stock JOIN shopstockrelation ON stock.StockId=shopstockrelation.StockId WHERE shopstockrelation.ShopEmail='".$_SESSION["shopOwnerEmail"]."'");

    $stockDetailData = json_decode($jsonShopOwnerString);

    if(isset($_POST['editSubmit']) && $_POST['PartsId']!="" && $_SERVER["REQUEST_METHOD"] == "POST"){
        $stockid=$_POST['PartsId'];
        $stockname=$_POST['PartsName'];
        $unitprice=$_POST['UnitPrice'];
        $totalunit=$_POST['TotalUnit'];
        $hiddenpartsid=$_POST['HiddenPartsId'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="UPDATE stock SET StockId='".$stockid."', PartsName ='".$stockname."', PricePerUnit ='".$unitprice."', TotalUnit ='".$totalunit."'  WHERE StockId='".$hiddenpartsid."'";
        $sqlRelation="UPDATE shopstockrelation SET StockId='".$stockid."' WHERE ShopEmail='".$_SESSION["shopOwnerEmail"]."' AND StockId='".$hiddenpartsid."'";

        //echo $sql;
        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else {
            $info=
                    '<div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Data Updating <strong>Failed!</strong>
                     </div>';
        }
    }
    if(isset($_POST['addanothersubmit']) && $_POST['AddPartsId']!="" && $_SERVER["REQUEST_METHOD"] == "POST"){
        $addstockid=$_POST['AddPartsId'];
        $addstockname=$_POST['AddPartsName'];
        $addtotalunit=$_POST['AddTotalUnit'];
        $addunitprice=$_POST['AddUnitPrice'];
        
        require ("shopOwnerPHP/updateDatabase.php");

        $sql="INSERT INTO stock (StockId, PartsName, PricePerUnit, TotalUnit) VALUES ('".$addstockid."','".$addstockname."','".$addunitprice."','".$addtotalunit."')";

        $sqlRelation="INSERT INTO shopstockrelation (StockId, ShopEmail) VALUES('".$addstockid."','".$_SESSION["shopOwnerEmail"]."')";
        
        //echo $sql."<br>";
        //echo $sqlRelation;

        if(updateDB($sql)==1){
            header("Refresh:0");
            updateDB($sqlRelation);
        }
        else{
            header("Refresh:0");
            $info=
                    '<div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Adding!</strong> Failed.
                     </div>';
        }
        
    }

    $jsonShopOwnerString = getJSONFromDB("SELECT ShopName FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."'");

    $jsonShopOwnerData = json_decode($jsonShopOwnerString);
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

    function partIdCheck(id){
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("errorMessage");
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="*Stock Id exist, Try another one";
                m.style.color= "red";
            }
            else{
                m.innerHTML="Good Choice!!";
                m.style.color= "green";
            }   
                
        }
    };
    var url="shopOwnerPHP/stockIdCheckAJAX.php?sid="+str;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }

    function partIdCheckOnAdd(id){
        //alert(id);
        str=document.getElementById(id).value;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("addErrorMessage");
            var i=xmlhttp.responseText;
            //alert(i);
            if(i==str){
                m.innerHTML="*Stock Id exist, Try another one";
                m.style.color= "red";
            }
            else{
                m.innerHTML="Good Choice!!";
                m.style.color= "green";
            }   
                
        }
    };
    var url="shopOwnerPHP/stockIdCheckAJAX.php?sid="+str;
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
                                                                          <input type="text" class="form-control" name="PartsId" id="parts_id<?php echo $i ?>" value="<?php echo $stockDetailData[$i]->StockId; ?>" onkeyup="partIdCheck('parts_id<?php echo $i; ?>')"><span id="errorMessage"></span>
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
                                                                        <label class="control-label col-sm-2" for="add_parts_id" >Parts Id:</label>
                                                                        <div class="col-sm-5">
                                                                          <input type="text" class="form-control" name="AddPartsId" id="add_parts_id" onkeyup="partIdCheckOnAdd('add_parts_id')" placeholder="Enter Parts Id"><span id="addErrorMessage"></span>
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
<?php include 'TemplateFile/footer.php'; ?>
