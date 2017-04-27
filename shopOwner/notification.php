<?php 
  $currentPage = 'notification';
  include("TemplateFile/header.php");

 ?>
<?php 

    //for retriving notification
    $sql="SELECT (SELECT name FROM carowner WHERE Email=notification.FromEmail) AS name,Date,Status,Type,ServiceId,NotificationId FROM notification WHERE ToEmail='".$_SESSION["shopOwnerEmail"]."' ORDER BY Date DESC";

    $jsonNotificationString = getJSONFromDB($sql);

    $notificationData = json_decode($jsonNotificationString);

    include("shopOwnerPHP/updateDatabase.php");

    if(isset($_POST['accept']) && $_SERVER["REQUEST_METHOD"] == "POST"){
      $notificationid=$_POST['NotificationId'];
      $email=$_POST['Email'];
      $serviceid=$_POST['ServiceId'];

      $sql="INSERT INTO notification(FromEmail, ToEmail, Type, Date, Status, ServiceId) VALUES ('".$_SESSION["shopOwnerEmail"]."','".$email."','2','".date("Y-m-d")."','unread', '".$serviceid."')";
      $resql="UPDATE service SET SecretKey=12345,Status='Accepted' WHERE ServiceId='".$serviceid."' ";

      $notificationsql="UPDATE notification SET Status='read' WHERE NotificationId=".$notificationid;

      //echo $sql."<br>";
      //echo $resql."<br>";
      //echo $notificationsql."<br>";

      if(updateDB($sql)==1){
        if(updateDB($resql)==1){
          if(updateDB($notificationsql)==1)
            header("Refresh:0");
        }
      }
    }

    else if(isset($_POST['reject']) && $_SERVER["REQUEST_METHOD"] == "POST"){
      $notificationid=$_POST['NotificationId'];
      $email=$_POST['Email'];
      $serviceid=$_POST['ServiceId'];
      $sql="INSERT INTO notification(FromEmail, ToEmail, Type, Date, Status, ServiceId) VALUES ('".$_SESSION["shopOwnerEmail"]."','".$email."','3','".date("Y-m-d")."','unread', '".$serviceid."')";
      $resql="UPDATE service SET SecretKey=12345,Status='Rejected' WHERE ServiceId='".$serviceid."' ";

      $notificationsql="UPDATE notification SET Status='read' WHERE NotificationId='".$notificationid."' ";

      if(updateDB($sql)==1){
        if(updateDB($resql)==1){
          if(updateDB($notificationsql)==1)
            header("Refresh:0");
        }
      }
    }


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

 ?>

         <!--  page-wrapper -->
        <div id="page-wrapper" style="background-color: #FFFFFF;">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Notifications</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center" style="font-size: 18px;">
                    <div class="alert alert-info">
                        <strong>Info!</strong> Click the notification body and show details!</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">

                <?php
                $flag=0;
                for($i=0;$i<sizeof($notificationData);$i++){
                  if($notificationData[$i]->Status=="unread"){
                    $flag++;
                 ?>
                     <span data-toggle="modal" data-target="#notificationModal<?php echo $i; ?>"> <b style="color:red"><?php echo $notificationData[$i]->name; ?></b> <?php if($notificationData[$i]->Type=="1") 
                                        echo "has requested for your help!";
                                     else if($notificationData[$i]->Type=="2") 
                                        echo "has accepted your request!";
                                     else if($notificationData[$i]->Type=="3") 
                                        echo "has rejected your request!";
                                     ?>  
                                     <strong style="color:green; margin-left: 20px;"><?php echo $notificationData[$i]->Date; ?></strong ></span>
                     <!-- Modal -->
                        <div class="modal fade" id="notificationModal<?php echo $i; ?>" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Notification Details</h4>
                              </div>
                              <?php
                              $jsonServiceString = getJSONFromDB("SELECT (SELECT name FROM carowner WHERE carowner.Email=service.CarOwnerEmail) AS name, ServiceId, CarOwnerEmail, VehicleRegNo, Date, Latitude, Longitude FROM service WHERE ServiceId='".$notificationData[$i]->ServiceId."' ");

                              $jsonServiceData = json_decode($jsonServiceString);

                              $jsonCarString = getJSONFromDB("SELECT (SELECT VehicleType FROM vehicle WHERE vehicle.vehicleRegNo=service.VehicleRegNo) AS type, (SELECT ModelName FROM vehicle WHERE vehicle.vehicleRegNo=service.VehicleRegNo) AS ModelName FROM service WHERE ServiceId='".$notificationData[$i]->ServiceId."' ");

                              $jsonCarData = json_decode($jsonCarString);


                              $location=getaddress($jsonServiceData[0]->Latitude,$jsonServiceData[0]->Longitude);

                              $dista=distance($jsonShopOwnerData[0]->Latitude,$jsonShopOwnerData[0]->Longitude,$jsonServiceData[0]->Latitude,$jsonServiceData[0]->Longitude,"K");
                               ?>
                              <div class="modal-body">
                                  <ul style="list-style-type: none;">
                                      <li><b>Name: </b> <span><?php echo $jsonServiceData[0]->name; ?></span></li>
                                      <li><b>Email: </b> <span><?php echo $jsonServiceData[0]->CarOwnerEmail; ?></span></li>
                                      <li><b>Car Details: </b>
                                          <ul style="list-style-type: none;">
                                              <li><b>Type: </b> <span><?php echo $jsonCarData[0]->type; ?></span></li>
                                              <li><b>Model Name: </b> <span><?php echo $jsonCarData[0]->ModelName; ?></span></li>
                                          </ul>
                                      </li>
                                      <li><b>Location:</b> <span><?php echo $location; ?></span></li>
                                      <li><b>Distance:</b> <span><?php echo $dista; ?></span></li>
                                  </ul>
                                  <form method="POST" action="" class="notification-details">
                                       <div class="form-group">
                                           <input type="hidden" name="NotificationId" value="<?php echo $notificationData[$i]->NotificationId; ?>">
                                           <input type="hidden" name="Email" value="<?php echo $jsonServiceData[0]->CarOwnerEmail; ?>">
                                           <input type="hidden" name="ServiceId" value="<?php echo $jsonServiceData[0]->ServiceId; ?>">
                                           <button class="btn btn-success" type="submit" name="accept">Accept</button>
                                           <button class="btn btn-danger" type="submit" name="reject">Reject</button>
                                       </div>
                                  </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        
                     <hr>
                <?php
                    }
                  }
                  if($flag==0){
                    ?>
                    <div class="col-md-8 text-center">
                        <div class="alert alert-danger"><strong>  You have no Notifications!</strong></div>
                    </div>
                    <?php
                  }
                  // echo sizeof($notificationData);
                ?>

                </div>
            </div>
            
        </div>
        <!-- end page-wrapper -->
<?php include 'TemplateFile/footer.php'; ?>
