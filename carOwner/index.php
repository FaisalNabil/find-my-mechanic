<?php 
      $currentPage = 'home';
      $info="";
   include 'TemplateFile/header.php'; 

   if(isset($_POST['send']) && $_SERVER["REQUEST_METHOD"] == "POST"){
      $vehicleRegNo=$_POST['Cars'];
      $messageBody=$_POST['messageBody'];
      $lat=$_POST['lat'];
      $long=$_POST['long'];
      $email=$_POST['email'];
      $var=date("md")+time();
      $serviceId=substr($_SESSION["carOwnerEmail"], 0,1).substr($email, 0,1).(string)$var;


      require ("phpFiles/updateDatabase.php");

      $sql="INSERT INTO service(ServiceId, CarOwnerEmail, ShopOwnerEmail, VehicleRegNo, Date, Latitude, Longitude, Status) VALUES ('".$serviceId."', '".$_SESSION["carOwnerEmail"]."', '".$email."', '".$vehicleRegNo."', '".date("Y-m-d")."', '".$lat."', '".$long."', 'Pending' )";

      $msgsql="INSERT INTO message(SenderMail, ReceiverMail, MessageBody, Date, Status) VALUES ('".$_SESSION["carOwnerEmail"]."','".$email."','".$messageBody."','".date("Y-m-d")."','unread')";

      $notificationsql="INSERT INTO notification(FromEmail, ToEmail, Type, Date, Status, ServiceId) VALUES ('".$_SESSION["carOwnerEmail"]."','".$email."','1','".date("Y-m-d")."','unread', '".$serviceId."')";

      //echo $notificationsql;
      if(updateDB($sql)==1){
        if(updateDB($notificationsql)==1){
          $info=
                    '<div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Request Sent Successfully</strong>
                     </div>';
          if($messageBody!=""){
            updateDB($msgsql);
          }
        }
      }
      else{
          $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Request Sending was Unsuccessfull</strong>
                     </div>';
      }
      
    }
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


        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="test">
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
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b><?php echo $carOwnerData[0]->Name; ?></b>
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

            <div class="row">
                <div class="col-lg-6 col-lg-offset-2">
                    <?php echo $info ; 
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
                                                    <td><?php echo sprintf('%0.2f',$km[$i]); ?> km</td>
                                                    <td><button class="btn btn-success" data-toggle="modal" data-target="#requestSendModal<?php echo $i ?>">Send Request</button>
                                               <!-- Modal -->
  <div class="modal fade" id="requestSendModal<?php echo $i ?>" role="dialog">
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
                        <select name="Cars">
                           <?php 
                                $jsonCarDetailsString = getJSONFromDB("SELECT * FROM vehicle JOIN ownervehiclerelation ON vehicle.VehicleRegNo=ownervehiclerelation.VehicleRegNo WHERE ownervehiclerelation.Email='".$_SESSION["carOwnerEmail"]."'");
                                $carDetailsData = json_decode($jsonCarDetailsString);
                            for($cars=0;$cars<sizeof($carDetailsData);$cars++){
                            ?>
                               <option value="<?php echo $carDetailsData[$cars]->VehicleRegNo ;?>"><?php echo $carDetailsData[$cars]->ModelName ;?></option>     
                            <?php 
                             }
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
                    <input type="hidden" name="lat" value="<?php echo $lat ?>">
                    <input type="hidden" name="long" value="<?php echo $lon ?>">
                    <input type="hidden" name="email" value="<?php echo $ShopOwnerData[$i]->Email ?>">
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-lg" name="send">Send</button>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
                                                    
                                                    <!-- End Modal -->
                                                    <button id="myButton" class="btn btn-primary"  onclick="viewProfile('<?php echo $ShopOwnerData[$i]->Email ;?>')" >View Profile</button>
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
        </div>
        <!-- end page-wrapper -->
   <?php include 'TemplateFile/footer.php'; ?>
