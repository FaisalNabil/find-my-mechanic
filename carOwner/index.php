<?php 


//include("phpFiles/SelectProfileData.php"); 

/*$jsonCarOwnerDataString = getJSONFromDB("select ShopName,Email,Address from shopowner where Email='".$_SESSION["carOwnerEmail"]."'");

$ShopOwnerData = json_decode($jsonCarOwnerDataString);*/


/*$jsonCarOwnerDataString = getJSONFromDB("select* from carowner ");*/

/*$AvailableServiceData = json_decode($jsonAvailableServiceDataString);*/

/*

$jsonAvailableServiceDataString = getJSONFromDB("select* from availableservices where ServicesId='A32'");

$AvailableServiceData = json_decode($jsonAvailableServiceDataString);

$jsonStockDataString = getJSONFromDB("select* from stock where StockId='2631'");*/

/*$StockData = json_decode($jsonStockDataString);

$jsonownerVehiclerelationDataString = getJSONFromDB("select* from ownervehiclerelation where Email='nabilt59@gmail.com'");

$OwnerVehicleRelationData = json_decode($jsonownerVehiclerelationDataString);*/


?>
      <?php 
            $currentPage = 'home';
            
         include 'TemplateFile/header.php'; 

         
      ?>
            <script>
                var x = document.getElementById("demo");

                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else { 
                        x.innerHTML = "Geolocation is not supported by this browser.";
                    }
                }

                function showPosition(position) {
                 
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;

                     window.location.href = "index.php?CurentLatitude="+ lat + "&CurrentLongitude=" + lon;
                }
                 
            </script>
            <?php 

                  if (isset($_GET['CurentLatitude']) && isset($_GET['CurrentLongitude'])) {
                $lat =  $_GET['CurentLatitude'];   

                //echo "<br>";
                $lon =  $_GET['CurrentLongitude'];  
              $jsonShopOwnerDataString = getJSONFromDB("select ShopName,Latitude,Longitude,Email from shopowner");
                 //echo $jsonShopOwnerDataString;
                $ShopOwnerData = json_decode($jsonShopOwnerDataString);


                function getaddress($lat,$lng)
                {
                  $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
                  $json = @file_get_contents($url);
                  $data=json_decode($json);
                  $status = $data->status;
                  if($status=="OK")
                    return $data->results[0]->formatted_address;
                  else
                    return false;
                }
                function distance($lat1, $lon1, $curlat, $curlon,$unit) {

                  $theta = $lon1 - $curlon;
                  $dist = sin(deg2rad($lat1)) * sin(deg2rad($curlat)) +  cos(deg2rad($lat1)) * cos(deg2rad($curlat)) * cos(deg2rad($theta));
                  $dist = acos($dist);
                  $dist = rad2deg($dist);
                  $miles = $dist * 60 * 1.1515;
                  $unit = strtoupper($unit);

                  if ($unit == "K") {
                  return ($miles * 1.609344);
                  } else if ($unit == "N") {
                    return ($miles * 0.8684);
                  } else {
                    return $miles;
                  }
                  
                } 
                 

                for($i = 0; $i<sizeof($ShopOwnerData); $i++)        
                  {
                  $km[] = distance($lat, $lon, $ShopOwnerData[$i]->Latitude, $ShopOwnerData[$i]->Longitude,"K");  
                 }

                 


              }

            ?>
            <!-- <script>
                        xmlhttp = new XMLHttpRequest();
                function viewProfile(shopownerEmail){
            
                  xmlhttp.onreadystatechange = function() {
                      
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          
                          var i=xmlhttp.responseText;
                          alert(i);
                              //m.innerHTML=i;
                              
                      }
                  };
                var url="phpFiles/ShopOwnerData.php?email="+shopownerEmail;
                alert(url);
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
                }
            </script> -->


        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Home</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12 text-center">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b>Faisal Nabil </b>
                        <i class="fa fa-map-marker"></i> <b>&nbsp; Now you are in <span class="location-color">

                        <?php 
                        if (isset($_GET['CurentLatitude']) && isset($_GET['CurrentLongitude'])) {

                            $lat= $_GET['CurentLatitude']; //latitude
                            $lng= $_GET['CurrentLongitude']; //longitude

                            $address= getaddress($lat,$lng);
                            if($address)
                            {
                            echo $address;
                            }
                            else
                            {
                            echo "Not found";
                            }
                          }
                        ?>
                          
                        </span></b>
                    </div>
                </div>
                <!--end  Welcome -->
            </div>


            <div class="row">
                <!--quick Help section -->
                <div class="col-lg-12 text-center">
                    <div class="alert alert-info">
                        <button class="btn btn-primary btn-lg" onclick="getLocation()">Search</button>
                    </div>
                </div>
                <!--end quick Help section -->
            </div>
            <!-- <p id="demo"></p> -->


           <?php

                
            /*$info = "";
             if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               
                 include 'phpFiles/Mysqldb.php';

                 $messageBody = '';
                 $carOwnerEmail = '';
                 $shopownerEmail = '';
                 $date = '';
                 $info = '';
                 $sql = '';

                if (!empty($_POST['messageBody'])){
                    
                     $messageBody    = htmlspecialchars(addslashes(trim($_POST['messageBody'])));

                     $carOwnerEmail  = 'nabilt59@gmail.com';// Value Come from SESSION
                     $shopownerEmail = $ShopOwnerData[0]->Email;
                     $date           = date("Y-m-d");

                     $sql = "insert into message values('$carOwnerEmail','$shopownerEmail','$messageBody','$date')"; 
                     
                      
                   
                    if (mysqli_query($conn, $sql)) {
                    $info = 
                    '<div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong>Message Send Successfully.
                     </div>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }else{
                    $info = 
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> You can\'t send blank message.
                     </div>';
                }
                
             }*/

           ?> 
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2">
                    <?php //echo $info ; 
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa fa-truck fa-fw"></i> Nearby Shops  
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>  
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Distance</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                               if (isset($_GET['CurentLatitude']) && isset($_GET['CurrentLongitude'])) {

                                                  for($i = 0; $i<sizeof($ShopOwnerData); $i++) {
                                                     
                                                 
                                               ?>
                                                <tr>
                                                    <td><?php echo ($i+1) ; ?></td>
                                                    <td><?php echo $ShopOwnerData[$i]->ShopName ;?></td>
                                                    <td><?php echo sprintf('%0.4f',$km[$i]); ?></td>
                                                    <td>

                                                    <form action="">
                                                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Send Request</button>
                      
                                                         <button id="myButton" class="btn btn-primary"  onclick='viewProfile("<?php echo $ShopOwnerData[$i]->Email ?>")'>View Profile</button>
                                                    </form>

  <!-- Modal -->
   

  <!-- <div class="modal fade" id="requestSendModal" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Help Request to ShopOwner</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="" method="post">
                 <div class="form-group">        
                  <label class="control-label col-sm-2">Select Your Car:</label>
                  <div class="col-sm-10">
                        <select>
                           <?php 
                                //foreach ($OwnerVehicleRelationData as $value) {
  
                            ?>
                               <option value="<?php //echo $value->VehicleRegNo ;?>"><?php //echo $value->VehicleRegNo ;?></option>     
                            <?php 
                             //}
                            ?>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="Message">Message:</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="5" id="Message" name="messageBody"></textarea>
                  </div>
                </div>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-lg">Send</button>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->
                                                        <!-- Modal -->
<!-- <div class="modal fade" id="viewProfile" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Shop Profile</h4>
    </div>
    <div class="modal-body">
       <form class="form-horizontal">
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">Name:</label>
          <div class="col-sm-10">
              <label for="shopName"><?php// echo $ShopOwnerData[0]->ShopName ; ?></label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="address">Address:</label>
          <div class="col-sm-10">          
              <label for="address"><?php //echo $ShopOwnerData[0]->Address ; ?></label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="services">Services & Parts:</label>
          <div class="col-sm-10">          
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Service Available</th>
                        <th>Service Cost</th>
                        <th>Available Parts</th>                         
                        <th>Price</th>                         
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        /*$i = 0; 
                        foreach ($AvailableServiceData as $value) {
                             $i++;*/
                        ?>
                        <tr>
                            <td><?php //echo $i; ?></td>
                            <td><?php// echo $value->ServiceName ; ?></td>
                            <td><?php //echo $value->Cost ; ?></td>

                            <?php //foreach($StockData as $stock ){?>

                               <td><?php //echo $stock->PartsName ; ?></td>
                               <td><?php //echo $stock->PricePerUnit ; ?></td>

                            <?php 
                             //}
                            ?>

                        </tr>
                    <?php 
                        //}
                    ?>
                       
                       
                    </tbody>
                </table>
          </div>
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  </div>
</div>  
</div>
</div>End Modal -->
                                                    </td>
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
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
   <?php include 'TemplateFile/footer.php'; ?>
