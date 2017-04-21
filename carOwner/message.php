
<?php  
      
    $currentPage = 'message';
             
    include "TemplateFile/header.php"; 

       
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

                     <?php include 'TemplateFile/messageInboxOpenModal.php'; ?>
                     <?php include 'TemplateFile/messageOutboxOpenModal.php'; ?>

                  </div>
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
 <?php include 'TemplateFile/footer.php'; ?>
