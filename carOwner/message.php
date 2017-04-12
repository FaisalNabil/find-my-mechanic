<!DOCTYPE html>
<html>
<?php session_start();
    require("phpFiles/SelectProfileData.php");
    require("phpFiles/updateDatabase.php");

    $jsonInboxString = getJSONFromDB("SELECT (SELECT ShopName FROM shopowner where Email=message.SenderMail) AS name,SenderMail,Date,MessageBody,Status FROM message WHERE ReceiverMail='".$_SESSION["carOwnerEmail"]."'   ORDER BY Date DESC");
    //echo $jsonInboxString;
    $inboxMessageData = json_decode($jsonInboxString);

    $jsonOutboxString = getJSONFromDB("SELECT (SELECT ShopName FROM shopowner where Email=message.ReceiverMail) AS name,Date,MessageBody,Status FROM message WHERE SenderMail='".$_SESSION["carOwnerEmail"]."'   ORDER BY Date DESC");
    //echo $jsonInboxString;
    $outboxMessageData = json_decode($jsonOutboxString);

    if(isset($_POST['send']) && $_POST['reply']!="" && $_SERVER["REQUEST_METHOD"] == "POST"){
        $reply=$_POST['reply'];             //message body
        $sendermail=$_POST['SenderMail'];

        $sql="INSERT INTO message(SenderMail, ReceiverMail, MessageBody, Date, Status) VALUES ('".$_SESSION["carOwnerEmail"]."','".$sendermail."','".$reply."','".date("Y-m-d")."','unread')";
        if(updateDB($sql)==1)
            header("Refreash:0");
    }
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

    <script type="text/javascript">
        xmlhttp = new XMLHttpRequest();
    function statusChange(id,senderMail){
        //alert(id);
        str=document.getElementById(id).innerText;
        //alert(str);

    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
            m=document.getElementById(id);
            var i=xmlhttp.responseText;
            //alert(i);
            if(i=="success"){
                m.innerText="";
            }
                //m.innerHTML=i;
                
        }
    };
    var url="phpFiles/messageStatus.php?sender="+senderMail;
    //alert(url);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    }
    </script>

   </head>
<body>
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
                <a class="navbar-brand logo-color" href="index.html">
                    Logo Goes Here
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger">3</span><i class="fa fa-envelope fa-3x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-danger">Faisal</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>1 minutes ago</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-info">Tuhin</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>5 hours ago</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="message-reply.html">
                                <div>
                                    <strong><span class=" label label-success">Sarwar</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>How can I help you?</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="message.php">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-messages -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-warning">2</span>  <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <!-- dropdown Notifications-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="notification.html">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>Help Request Sent Successfully
                                    <span class="pull-right text-muted small"> 1 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="notification.html">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>Tuhin Accept Your Request
                                    <span class="pull-right text-muted small"> 0 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="notification.html">
                                <strong>See All Notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-Notifications -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        <li><a href="setting.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
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
                            <div class="user-section-inner">
                                <img src="../assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div>Tuhin Ent.</div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <hr>

                    <li>
                        <a href="index.html"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                    </li>
                    <li class="selected">
                        <a href="message.php"><i class="fa fa-comment fa-fw"></i>Messages</a>
                    </li>
                    <li>
                        <a href="notification.html"><i class="fa fa-bell fa-fw"></i>Notification</a>
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
        <div id="page-wrapper" style="background-color: #FFFFFF;" >

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Message</h1>
                </div>
                <!--End Page Header -->
            </div>
            <div class="row">
                <div class="col-md-12">
                 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#inbox">Inbox</a></li>
    <li><a data-toggle="tab" href="#outbox">Outbox</a></li>
  </ul>
  <div class="tab-content">
    <div id="inbox" class="tab-pane fade in active">
       <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<sizeof($inboxMessageData);$i++){
                ?>
              <tr>
                <td><?php echo $inboxMessageData[$i]->name; ?></td>
                <td><?php echo $inboxMessageData[$i]->Date; ?></td>
                <td>
                  <button type="button" onclick="statusChange('status<?php echo $i; ?>','<?php echo $inboxMessageData[$i]->SenderMail ?>')" class="btn btn-info" data-toggle="modal" data-target="#open<?php echo $i ?>">Open</button>
                  <!-- Modal -->
                  <div class="modal fade" id="open<?php echo $i ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Message Details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="sendeName">Sender:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $inboxMessageData[$i]->name ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Email:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $inboxMessageData[$i]->SenderMail ?></span>
                                    </div>
                                </div>
                                <input type="hidden" name="SenderMail" value="<?php echo $inboxMessageData[$i]->SenderMail ?>">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="message">Message: </label>
                                    <div class="col-sm-10">          
                                       <span><?php echo $inboxMessageData[$i]->MessageBody ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="reply">Reply: </label>
                                    <div class="col-sm-10">          
                                        <textarea class="form-control" rows="5" id="reply" name="reply"></textarea>
                                    </div>
                                </div>
                                 <button type="submit" name="send" class="btn btn-primary margin-left">Send</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>

                </td>
                <td id="status<?php echo $i; ?>"><?php if($inboxMessageData[$i]->Status == "unread") echo "Unread"; ?></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
    </div>

    <div id="outbox" class="tab-pane fade">
       <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<sizeof($outboxMessageData);$i++){
                ?>
              <tr>
                <td><?php echo $outboxMessageData[$i]->name; ?></td>
                <td><?php echo $outboxMessageData[$i]->Date; ?></td>
                <td>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#outboxMessage<?php echo $i; ?>">Open</button>
                  <!-- Modal -->
                  <div class="modal fade" id="outboxMessage<?php echo $i; ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Message Details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="receiverName">To:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $outboxMessageData[$i]->name; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="message">Message: </label>
                                    <div class="col-sm-10">          
                                       <span><?php echo $outboxMessageData[$i]->MessageBody; ?></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>

                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
    </div>
  </div>
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
     

</body>

</html>
