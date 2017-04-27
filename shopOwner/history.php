<?php 

  $currentPage = 'history';
  include("TemplateFile/header.php");

  $jsonServiceString = getJSONFromDB("SELECT (SELECT name FROM carowner WHERE Email=service.CarOwnerEmail) AS name,Date,VehicleRegNo,SecretKey,Status FROM service WHERE ShopOwnerEmail='".$_SESSION["shopOwnerEmail"]."' ORDER BY Date DESC");

  $jsonServiceData = json_decode($jsonServiceString);

?>

        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">History</h1>
                </div>
                <!--End Page Header -->
                <div class="col-md-offset-6 col-md-6">
                    <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                </div>
                 
            </div>
            <?php 
            for($i=0;$i<sizeof($jsonServiceData);$i++){
                ?>
                <div class="row">
                    <div class="col-md-8">
                       <div class="alert alert-info">
                            <strong>Name: </strong><span><?php echo $jsonServiceData[$i]->name; ?></span>
                            <em class="pull-right"><?php echo $jsonServiceData[$i]->Date; ?></em>
                            <div>
                                <strong>Vehicle Registration Number: </strong><span><?php echo $jsonServiceData[$i]->VehicleRegNo; ?></span>
                            </div>
                            <div>
                                <div class="pull-right">
                                    <span class=" label label-danger"><?php echo $jsonServiceData[$i]->Status; ?></span>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                <hr style="color: black">
            <?php    
            }
            ?>
            

            <div class="row">
                <div class="col-md-12">
                    <ul class="pagination pagination-lg">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul>
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
