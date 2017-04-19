<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/jquery.datepick.css" rel="stylesheet" />
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/jquery.datepick.css" rel="stylesheet" />

   <link href="assets/css/style.css" rel="stylesheet" />
   <link href="assets/css/main-style.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<?php
  include("carAction.php");
?>
<script>
  function passwordCheck(str){
    var xhttp;
    cpwd = document.forms[0].elements[6].value;
    pmsg = document.getElementById("ipwd");
    if(cpwd.length < 6){
      pmsg.innerHTML = "minimun 6 char";
    }
    else{
      pmsg.innerHTML = "";
    }
  }
  
  function conPasswordCheck(str){
    cpwd = document.forms[0].elements[6].value;
    conPwd= document.forms[0].elements[7].value;
    con = document.getElementById("conP");
    if(cpwd != conPwd){
      con.innerHTML = "password are not match";
    }
    else{
      con.innerHTML = "";
    }
  }
  
  $(document).ready(function(){
    $("input").focus(function(){
      $(this).css("background-color","#cccccc");
    });
    $("input").blur(function(){
      $(this).css("background-color", "#ffffff");
    });
  });
  
</script>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-primary">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Enter Your information</h3>
                    </div>
                    <div class="panel-body">
                          <form class="form-horizontal" action = "" method = "Post">

                             <div class="form-group">
                                <label class="control-label col-sm-2" for="Name">Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerName" id="name" placeholder="Enter Name" required>
                                  <span style="color:red"><?php echo $nameError; ?></span> <!--Name Error Show-->
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" name = "carOwnerEmail" id="email" placeholder="Enter email" required>
                                  <span style="color:red"><?php echo $emailError; ?></span> <!--Email Error Show-->
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Contact:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerPhone" id="pwd" placeholder="Enter Contact Number" required="">
                                  <span style="color:red"><?php echo $phoneError; ?></span> <!--phone Error Show-->
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="DOB">DOB:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name = "carOwnerDOB" id="popupDatepicker" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="nid">NID:</label>
                                <div class="col-sm-10">
                                  <input type="number" class="form-control" id="nid" name = "carOwnerNid" placeholder="Enter NID Number" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="dlc">Driving Licence:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="dlc" name = "carOwnerDriving" placeholder="Enter Driving Licence" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" onkeyup = "passwordCheck(carOwnerPWD)" name = "carOwnerPWD" placeholder="Enter Password" required>
                                  <span id = "ipwd" style="color:red"><?php echo $passError; ?></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="pwd" onkeyup = "conPasswordCheck(carOwnerCPWD)" name = "carOwnerCPWD" placeholder="Enter Password Again" required>
                                  <span id = "conP" style="color:red"><?php echo $conPassError; ?></span>
                                </div>
                              </div>
                               <div class="form-group">
                                  <label class="control-label col-sm-2" for="comment">Address:</label>
                                  <div class="col-sm-10">
                                      <textarea class="form-control" id="comment" name = "carOwnerAddress" required=""></textarea>
                                  </div>
                                  
                               </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
    
   
    <script src="assets/plugins/jquery-1.12.0.min.js"></script>
    <script src="assets/plugins/jquery.plugin.min.js"></script>
   <script src="assets/plugins/jquery.datepick.js"></script>

<script>
$(function() {
  $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
   
});
</script>
    
</body>

</html>