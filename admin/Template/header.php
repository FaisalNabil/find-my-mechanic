<?php session_start(); ?>
<?php
    
    include("phpFiles/selectData.php");

    $jsonInboxString = getJSONFromDB("SELECT SenderMail,Date,MessageBody,Status FROM message WHERE ReceiverMail='".$_SESSION["adminEmail"]."' ORDER BY Date DESC"); //inbox messages
    //echo $jsonInboxString;
    $inboxMessageData = json_decode($jsonInboxString);

    $jsonCountUnreadString = getJSONFromDB("SELECT Status FROM message WHERE ReceiverMail='".$_SESSION["adminEmail"]."' AND Status='unread' "); //counting unread message
    //echo $jsonCountUnreadString;
    $countMessageData = json_decode($jsonCountUnreadString);

?>
<!DOCTYPE html>
<html>
<head>
<?php if (!isset($_SESSION["adminEmail"])) {
    header("Location:../login.php");
} ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebTechnology Final Project</title>
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />
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
                                    <strong><span class=" label label-danger"><?php echo $inboxMessageData[$i]->SenderMail; ?></span></strong>
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
                            <a class="text-center" href="message.html">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-messages -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="setting.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../session_destroy.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
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
                            <div class="user-info">
                                <div><strong>Admin</strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <hr>

                    <li class="<?php if($currentPage =='home'){echo 'selected';}?>">
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                    </li>
                    <li class="<?php if($currentPage =='shopOwner'){echo 'selected';}?>">
                        <a href="shopOwnerList.php"><i class="fa fa-ship fa-fw"></i>Shop Owner List</a>
                    </li>
                    <li class="<?php if($currentPage =='carOwner'){echo 'selected';}?>">
                        <a href="carOwnerList.php"><i class="fa fa-car fa-fw"></i>Car Owner List</a>
                    </li>
                    <li class="<?php if($currentPage =='message'){echo 'selected';}?>">
                        <a href="message.php"><i class="fa fa-envelope fa-fw"></i>Messages</a>
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
               <!-- end navbar side -->
        <!--  page-wrapper -->