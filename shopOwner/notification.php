<?php include("TemplateFile/header.php"); ?>
<?php 

    //for retriving notification
    $sql="SELECT (SELECT name FROM carowner where Email=notification.FromEmail) AS name,Date FROM notification WHERE ToEmail='".$_SESSION["shopOwnerEmail"]."'";

    $jsonNotificationString = getJSONFromDB($sql);

    $notificationData = json_decode($jsonNotificationString);

    //for user name
    $jsonShopOwnerString = getJSONFromDB("SELECT ShopName FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."'");

    $jsonShopOwnerData = json_decode($jsonShopOwnerString);

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
                        <strong>Info!</strong> Click the notification body and show details!</a>.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">

                <?php
                for($i=0;$i<sizeof($notificationData);$i++){
                  
                 ?>
                     <span data-toggle="modal" data-target="#myModal"> <b style="color:red"><?php echo $notificationData[$i]->name; ?></b> has requested for your help! <strong style="color:green; margin-left: 20px;"><?php echo $notificationData[$i]->Date; ?></strong ></span>
                     <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Notification Details</h4>
                              </div>
                              <div class="modal-body">
                                  <ul style="list-style-type: none;">
                                      <li><b>Name: </b> <span>Sarwar CarWash</span></li>
                                      <li><b>Email: </b> <span>hosensarwar007@gmail.com</span></li>
                                      <li><b>Car Details: </b>
                                          <ul style="list-style-type: none;">
                                              <li><b>Type: </b> <span>Micro Bus</span></li>
                                              <li><b>Model Name: </b> <span>Toyota</span></li>
                                          </ul>
                                      </li>
                                      <li><b>Location:</b> <span>Sector-3, Uttara, Dahka</span></li>
                                      <li><b>Distance:</b> <span>12km</span></li>
                                  </ul>
                                  <form action="" class="notification-details">
                                       <div class="form-group">
                                           <button class="btn btn-success">Accept</button>
                                           <button class="btn btn-danger">Reject</button>
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
                ?>

                </div>
            </div>
            
        </div>
        <!-- end page-wrapper -->


<?php include 'TemplateFile/footer.php'; ?>
