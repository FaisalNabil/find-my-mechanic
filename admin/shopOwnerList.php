<?php 
$currentPage="shopOwner";
include("Template/header.php");

$jsonShopOwnerDataString = getJSONFromDB("SELECT * FROM shopowner"); 
$shopOwnerData = json_decode($jsonShopOwnerDataString);


?>
<script>
xmlhttp = new XMLHttpRequest();
	function update(email,status){
		//alert(email);
    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
            var i=xmlhttp.responseText;
            if(i=="success")
                location.reload();
			else
				alert("Update Failed");
        }
    };
    var url="phpFiles/shopPendingUpdate.php?email="+email+"&status="+status;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
	}
</script>

        <div id="page-wrapper" style="background-color: #FFFFFF;">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Shop Owner List</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#active_list">Active</a></li>
                        <li><a data-toggle="tab" href="#pending_list">Pending</a></li>
                        <li><a data-toggle="tab" href="#disabled_list">Disabled</a></li>
                    </ul>

                      <div class="tab-content">
                        <div id="active_list" class="tab-pane fade in active">
                           
                           <table class="table table-condensed">
                                <thead>
                                  <tr>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=0;$i<sizeof($shopOwnerData);$i++){
											if($shopOwnerData[$i]->Status=="Active"){
									?>
										<tr>
											<td><?php echo $shopOwnerData[$i]->ShopName; ?></td>
											<td><?php echo $shopOwnerData[$i]->Email; ?></td>
											<td><button type="button" class="btn btn-info"  onclick="update('<?php echo $shopOwnerData[$i]->Email; ?>','disable')">Disable</button> <button type="button" class="btn btn-danger"  onclick="update('<?php echo $shopOwnerData[$i]->Email; ?>','remove')">Delete</button></td>
										</tr>
									<?php
											}
										}
									?>
                                </tbody>
                            </table>
                        </div>
                        <div id="pending_list" class="tab-pane fade">
                           <table class="table table-condensed">
                                <thead>
                                  <tr>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
										for($i=0;$i<sizeof($shopOwnerData);$i++){
											if($shopOwnerData[$i]->Status=="Pending"){
									?>
										<tr>
											<td><?php echo $shopOwnerData[$i]->ShopName; ?></td>
											<td><?php echo $shopOwnerData[$i]->Email; ?></td>
											<td><button type="button" class="btn btn-success" onclick="update('<?php echo $shopOwnerData[$i]->Email; ?>','active')">Activate</button></td>
										</tr>
									<?php
											}
										}
									?>
                                </tbody>
                            </table>
                        </div>
                        <div id="disabled_list" class="tab-pane fade">
                          <table class="table table-condensed">
                                <thead>
                                  <tr>
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
										for($i=0;$i<sizeof($shopOwnerData);$i++){
											if($shopOwnerData[$i]->Status=="Disable"){
									?>
										<tr>
											<td><?php echo $shopOwnerData[$i]->ShopName; ?></td>
											<td><?php echo $shopOwnerData[$i]->Email; ?></td>
											<td><button type="button" class="btn btn-success" onclick="update('<?php echo $shopOwnerData[$i]->Email; ?>','active')">Activate</button></td>
										</tr>
									<?php
											}
										}
									?>
                                </tbody>
                            </table>
                        </div>

                      </div>
                </div>
            </div>
        </div>
<?php include("Template/footer.php"); ?>