<?php 

  $currentPage = 'home';
  include("TemplateFile/header.php");

    $jsonOngoingString = getJSONFromDB("SELECT (SELECT name FROM carowner WHERE Email=service.CarOwnerEmail) AS name,ServiceId,VehicleRegNo,SecretKey FROM service WHERE ShopOwnerEmail='".$_SESSION["shopOwnerEmail"]."' AND Status='Accepted' ORDER BY Date DESC"); 
    
    $jsonOngoingData = json_decode($jsonOngoingString);

?>

<script type="text/javascript">
        xmlhttp = new XMLHttpRequest();
    function jobDone(id){
        //alert(id);
        //str=document.getElementById(id).innerText;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            var i=xmlhttp.responseText;
            //alert(i);
            if(i=="success"){
                location.reload();
            }
                //m.innerHTML=i;
                
        }
    };
    var url="shopOwnerPHP/jobDone.php?sid="+id;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }
    </script>

        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Home</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div>
                <h3>Ongoing Jobs</h3><hr>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <?php 
                    if(sizeof($jsonOngoingData)>0){
                        for($i=0;$i<sizeof($jsonOngoingData);$i++){
                            ?>
                            <div class="col-md-20">
                                <div class="alert alert-success">
                                Job for <strong><?php echo $jsonOngoingData[$i]->name;?></strong> with vehicle <strong><?php echo $jsonOngoingData[$i]->VehicleRegNo;?></strong> has secret key <strong><?php echo $jsonOngoingData[$i]->SecretKey;?></strong>
                                <button class="btn btn-primary job-done-btn" onclick="jobDone('<?php echo $jsonOngoingData[$i]->ServiceId; ?>')">Job Done</button>
                                </div>
                            </div> 
                        <?php
                        }
                    }
                    else{
                        ?>
                    
                    <div class="col-md-7">
                        <div class="alert alert-danger"><strong>  You have no ongoing jobs!!</strong></div>
                    </div>
                    <?php
                }
                    ?>
                </div>

            </div>
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
