<?php 
  $info="";
  include("TemplateFile/header.php");
?>
<?php  

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
            $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Data Updating <strong>Failed!</strong>
                     </div>';
        }
    }
    else if(isset($_POST['editSubmit'])){
            $info=
                    '<div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Data Updating <strong>Failed!</strong>
                     </div>';
        }

?>

<script>

  xmlhttp = new XMLHttpRequest();
  //Checks Email
  function emailvCheck(id){ 
    str=document.getElementById(id).value;

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("emailError");
            var i=xmlhttp.responseText;
            if(str == null || str == ""){
              m.innerHTML = "Email must be filled out";
            }
            else if(i==str){
                m.innerHTML="*Email exist, Try another one";
            }
            else{
                m.innerHTML="";
            }            
        }
    };
    var url="shopValidation/emailCheck.php?shopOwnerEmail="+str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  }

  //phone number check
  function numbervCheck(id){
    str=document.getElementById(id).value;
    m=document.getElementById("phoneError");

    if(isNaN(str)){
      m.innerHTML = "only numbers are allowed";
    }
    else if(str == null || str ==""){
      m.innerHTML = "Contact number must be filled out";
    }else{
      m.innerHTML="";
    }
  }
  //shop trade licence check
  function tradevCheck(id){
    str=document.getElementById(id).value;

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && id!="") {
            
            m=document.getElementById("tdnError");
            var i=xmlhttp.responseText;
            if(str == null || str == ""){
              m.innerHTML = "Trade Licence must be filled out";
            }
            else if(i==str){
                m.innerHTML="*Trade Licence number exist, Try another one";
            }
            else{
                m.innerHTML="";
            }         
        }
    };
    var url="../shopValidation/tradeLicenceCheck.php?shopOwnerTDN="+str;
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
                    <h1 class="page-header">Profile</h1>
                    <?php echo $info; ?>
                </div>
                <!--End Page Header -->
            </div>
            <div class="cow">
                <div class="col-lg-12">
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
                                                  <input type="text" class="form-control" id="name" name="ShopName" placeholder="" value="<?php echo $jsonShopOwnerData[0]->ShopName; ?>">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="contact">Contact:</label>
                                                <div class="col-sm-5">
                                                  <input type="text" class="form-control" id="contact" name="Contact" placeholder="" value="<?php echo $jsonShopOwnerData[0]->Contact; ?>" onkeyup = "numbervCheck('contact')">
                                                  <span id = "phoneError" style="color:red"></span>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="shoptradeLicence">Shop Trade Licence:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="shoptradeLicence" name="ShopTradeLicence" placeholder="" value="<?php echo $jsonShopOwnerData[0]->ShopTradeLicence; ?>" required="" onkeyup = "tradevCheck('shoptradeLicence')">
                                                  <span id = "tdnError" style="color:red"></span>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="maps_latitude">Google Maps Latitude:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="maps_latitude" name="Latitude" placeholder="" value="<?php echo $jsonShopOwnerData[0]->Latitude; ?>" required="">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="maps_longitude">Google Maps Longitude:</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="maps_longitude" name="Longitude" placeholder="" value="<?php echo $jsonShopOwnerData[0]->Longitude; ?>" required="">
                                                </div>
                                              </div>

                                              <input type="hidden" class="form-control" id="Hidden_Shop_Email" name="HiddenEmail" placeholder="" value="<?php echo $jsonShopOwnerData[0]->Email; ?>">

                                              <div class="form-group">
                                                <label class="control-label col-sm-2" for="address">Location:</label>
                                                <div class="col-sm-5">
                                                   <textarea class="form-control" id="address" name="Location" required=""><?php echo $jsonShopOwnerData[0]->Address; ?></textarea>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-2">
                                                  <button type="submit" name="editSubmit" class="btn btn-primary">Save Changes</button>
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
<?php include 'TemplateFile/footer.php'; ?>
