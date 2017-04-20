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

        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Notifications</h1>
                </div>
                <!--End Page Header -->
                <?php
                for($i=0;$i<sizeof($notificationData);$i++){
                 ?>
                 <div>
                     <span><?php echo $notificationData[$i]->Date; ?></span> <p><B><?php echo $notificationData[$i]->name; ?></B> has requested for your help</p>
                 </div>
                 <?php
                  }
                ?>
            </div>
            
        </div>
        <!-- end page-wrapper -->
<?php include 'TemplateFile/footer.php'; ?>
