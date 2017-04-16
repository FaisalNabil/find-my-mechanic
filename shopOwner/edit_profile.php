<?php session_start();
    require "shopOwnerPHP/selectFromDatabase.php"; 

    $jsonShopOwnerString = getJSONFromDB("SELECT * FROM shopowner WHERE Email='".$_SESSION["shopOwnerEmail"]."'");
    //echo $_SESSION["shopOwnerEmail"];

    $shopOwnerData = json_decode($jsonShopOwnerString);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        require "shopOwnerPHP/updateDatabase.php";

        if (!empty($_POST['ShopName']) && !empty($_POST['Contact']) && !empty($_POST['ShopTradeLicence']) && !empty($_POST['Latitude']) && !empty($_POST['Longitude']) && !empty($_POST['Location']) )

        {
          $shopName         = $_POST['ShopName'];
          $contact          = $_POST['Contact'];    
          $shopTradeLicence = $_POST['ShopTradeLicence'];  
          $latitude         = $_POST['Latitude'];   
          $longitude        = $_POST['Longitude'];
          $location         = $_POST['Location'];


        }
       

        $sql = "UPDATE shopowner SET ShopName ='".$shopName."', Contact='".$contact."',Latitude = '".$latitude."',Longitude='".$longitude."',Address ='".$location."',ShopTradeLicence='".$shopTradeLicence."' WHERE Email='".$_SESSION["shopOwnerEmail"]."'";
        
        if (updateDB($sql)==1) {
            echo "<script type='text/javascript'>alert('Successfully updated');</script>";
            header("Refresh:0");
        } else {
            echo "<script type='text/javascript'>alert('Updated Failed');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <?php include("TemplateFile/head.php"); ?>
   </head>
<body <?php $info=''; ?> >
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
                <a class="navbar-brand logo-color" href="index.php">
                    Logo Goes Here
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <?php include("TemplateFile/messageTemplate.php"); ?>
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
                            <div class="user-info">
                                <div><?php echo $shopOwnerData[0]->ShopName; ?></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <hr>

                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                    </li>
                    <li>
                        <a href="message.php"><i class="fa fa-comment fa-fw"></i>Messages</a>
                    </li>
                    <li>
                        <a href="notification.php"><i class="fa fa-bell fa-fw"></i>Notification</a>
                    </li>
                    <li>
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
                    <h1 class="page-header">Profile</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="cow">
                <div class="col-lg-12">
                     <?php echo $info ; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil-square-o fa-fw"></i> Edit Profile  
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                         <form class="form-horizontal" action="" method="post">
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="name">Shop Name:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="name" name="ShopName" placeholder="" value="<?php echo $shopOwnerData[0]->ShopName; ?>">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="contact">Contact:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="contact" name="Contact" placeholder="" value="<?php echo $shopOwnerData[0]->Contact; ?>">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="shoptradeLicence">Shop Trade Licence:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="shoptradeLicence" name="ShopTradeLicence" placeholder="" value="<?php echo $shopOwnerData[0]->ShopTradeLicence; ?>" required="">
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="maps_latitude">Google Maps Latitude:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="maps_latitude" name="Latitude" placeholder="" value="<?php echo $shopOwnerData[0]->Latitude; ?>" required="">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="maps_longitude">Google Maps Longitude:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="maps_longitude" name="Longitude" placeholder="" value="<?php echo $shopOwnerData[0]->Longitude; ?>" required="">
                                                </div>
                                              </div>

                                              <input type="hidden" class="form-control" id="Hidden_Shop_Email" name="HiddenEmail" placeholder="" value="<?php echo $shopOwnerData[0]->Email; ?>" required="">

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="address">Location:</label>
                                                <div class="col-sm-5">
                                                   <textarea class="form-control" id="address" name="Location" required=""><?php echo $shopOwnerData[0]->Address; ?></textarea>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-2">
                                                  <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                              </div>
                                         </form>
                                         <div class="col-sm-2">
                                                  <a href="profile.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                         </div>
                                         
                                    </div>

                                </div>

                            </div>
                            <!-- row -->
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!--End simple table example -->
                </div>  
            </div>
            
             
             
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
     
</body>

</html>
