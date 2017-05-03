<?php

    $jsonInboxString = getJSONFromDB("SELECT (SELECT ShopName FROM shopowner where Email=message.SenderMail) AS name,SenderMail,Date,MessageBody,Status FROM message WHERE ReceiverMail='".$_SESSION["carOwnerEmail"]."' ORDER BY Date DESC"); //inbox messages
    //echo $jsonInboxString;
    $inboxMessageData = json_decode($jsonInboxString);

    $jsonCountUnreadString = getJSONFromDB("SELECT Status FROM message WHERE ReceiverMail='".$_SESSION["carOwnerEmail"]."' AND Status='unread' "); //counting unread message
    //echo $jsonCountUnreadString;
    $countMessageData = json_decode($jsonCountUnreadString);


    $jsonCountNotificationString = getJSONFromDB("SELECT Status FROM notification WHERE ToEmail='".$_SESSION["carOwnerEmail"]."' AND Status='unread' "); //counting unread notification
    
    $countNotificationData = json_decode($jsonCountNotificationString);

?>

<ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger"><?php echo count($countMessageData); ?></span><i class="fa fa-envelope fa-3x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <?php 
                        for($i=0;$i<sizeof($inboxMessageData);$i++){
                            if(count($countMessageData)!=0){
                                if($inboxMessageData[$i]->Status=="unread"){
                            ?>
                            <li>
                            <a href="message.php">
                                <div>
                                    <strong><span class=" label label-danger"><?php echo $inboxMessageData[$i]->name; ?></span></strong>
                                    <span class="pull-right text-muted">
                                        <em><?php echo $inboxMessageData[$i]->Date; ?></em>
                                    </span>
                                </div>
                                <div><?php echo $inboxMessageData[$i]->MessageBody; ?></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php
                                }
                            }
                        }
                        ?>
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
                        <span class="top-label label label-warning"><?php echo count($countNotificationData); ?></span>  <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <!-- dropdown Notifications-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="notification.php">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i><?php echo count($countNotificationData); ?> New Requests
                                    <span> See All Notifications</span>
                                </div>
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