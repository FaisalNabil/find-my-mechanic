<?php 
$currentPage = 'notification';
include("TemplateFile/header.php"); 

?>
<?php 

    //for retriving notification
    $sql="SELECT (SELECT ShopName FROM shopowner WHERE Email=notification.FromEmail) AS name,Date,Status,Type,ServiceId,NotificationId FROM notification WHERE ToEmail='".$_SESSION["carOwnerEmail"]."' ORDER BY Date DESC";

    $jsonNotificationString = getJSONFromDB($sql);

    $notificationData = json_decode($jsonNotificationString);

    include("phpFiles/updateDatabase.php");

    if(isset($_POST['ok']) && $_SERVER["REQUEST_METHOD"] == "POST"){
      $notificationid=$_POST['NotificationId'];

      $notificationsql="UPDATE notification SET Status='read' WHERE NotificationId=".$notificationid;

      if(updateDB($notificationsql)==1)
            echo "done";
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
                        <strong>Info!</strong> Key numbers are confidential. Please save it!</a>.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">

                <?php
                for($i=0;$i<sizeof($notificationData);$i++){
                  if($notificationData[$i]->Status=="unread"){
                 ?>
                     <span data-toggle="modal" data-target="#myModal<?php echo $i; ?>"> <b style="color:red"><?php echo $notificationData[$i]->name; ?></b> <?php if($notificationData[$i]->Type=="1") 
                                        echo "has requested for your help! ";
                                     else if($notificationData[$i]->Type=="2") 
                                        echo "has accepted your request! ";
                                     else if($notificationData[$i]->Type=="3") 
                                        echo "has rejected your request! ";
                                     ?>
                                     <strong style="color:green; margin-left: 20px;"><?php echo $notificationData[$i]->Date; ?></strong ></span>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Notification Details</h4>
                              </div>
                              <?php
                              $jsonServiceString = getJSONFromDB("SELECT (SELECT ShopName FROM shopowner WHERE shopowner.Email=service.ShopOwnerEmail) AS name, ServiceId, ShopOwnerEmail,SecretKey FROM service WHERE ServiceId='".$notificationData[$i]->ServiceId."' ");

                              $jsonServiceData = json_decode($jsonServiceString);

                               ?>
                              <div class="modal-body">
                                  <ul style="list-style-type: none;">
                                      <li><b>Name: </b> <span><?php echo $jsonServiceData[0]->name; ?></span></li>
                                      <li><b>Email: </b> <span><?php echo $jsonServiceData[0]->ShopOwnerEmail; ?></span></li>
                                      <li><b>Key:</b> <span><?php echo $jsonServiceData[0]->SecretKey; ?></span></li>
                                  </ul>
                                  <form method="POST" action="" class="notification-details">
                                       <div class="form-group">
                                           <input type="hidden" name="NotificationId" value="<?php echo $notificationData[$i]->NotificationId; ?>">
                                           <button class="btn btn-success" type="submit" name="ok">OK</button>
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
                ?>

                </div>
            </div>
            
        </div>
        <!-- end page-wrapper -->
<?php include 'TemplateFile/footer.php'; ?>
