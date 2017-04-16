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

       <?php 
             $currentPage = 'message';
             
             include "TemplateFile/header.php"; 

       ?>

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
 <?php include 'TemplateFile/footer.php'; ?>
