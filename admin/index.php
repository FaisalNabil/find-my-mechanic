<?php 
$currentPage="home";
include("Template/header.php");

$jsonServiceString = getJSONFromDB("SELECT * FROM notification ORDER BY Date DESC");

$jsonSeviceData = json_decode($jsonServiceString);
//echo $jsonServiceString;
?>
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Home</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <h3 style="text-align: center;"><b><p>Ongoing services</p></b></h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                <?php
                for($i=0;$i<sizeof($jsonSeviceData);$i++){
                    if($jsonSeviceData[$i]->Type=="1"){
                 ?>
                     <p><b><?php echo $jsonSeviceData[$i]->FromEmail; ?></b> asked help from <b><?php echo $jsonSeviceData[$i]->ToEmail; ?></b>
                     <?php
                     }
                     else if($jsonSeviceData[$i]->Type=="2"){
                 ?>
                     <p><b><?php echo $jsonSeviceData[$i]->FromEmail; ?></b> accepted request of <b><?php echo $jsonSeviceData[$i]->ToEmail; ?></b>
                     <?php
                     }else if($jsonSeviceData[$i]->Type=="3"){
                 ?>
                     <p><b><?php echo $jsonSeviceData[$i]->FromEmail; ?></b> rejected request of <b><?php echo $jsonSeviceData[$i]->ToEmail; ?></b>
                     <?php
                     }
                     ?><span><sup>  <?php echo $jsonSeviceData[$i]->Date; ?></sup></span></p>
                     <hr width="10%">
                     <?php
                }
                ?>
                </div>
            </div>
        </div>
<?php include("Template/footer.php"); ?>
