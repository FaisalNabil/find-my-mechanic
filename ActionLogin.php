<?php session_start();
    $loginfailed = $email = $emptyData = $statusError = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        function getJSONFromDB($sql){
            $conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
            $arr=array();
            while($row = mysqli_fetch_assoc($result)) {
                $arr[]=$row;
            }
            return json_encode($arr);
        }

        $sql="select password,flag,Status from carshop where email = '".$email."'";
        $jsonData= getJSONFromDB($sql);
        $json=json_decode($jsonData);
        if($jsonData=="[]"){
            $emptyData = "Email not found"; 
            //echo "not found";  
        }else{
            if($json[0]->Status == 'Active'){
                if($json[0]->flag == 2 && $json[0]->password == $password){
                $_SESSION["shopOwnerEmail"] = $email;
                header("Location: shopOwner/index.html");
                }
                elseif($json[0]->flag == 1 && $json[0]->password == $password){
                    $_SESSION["carOwnerEmail"] = $email;
                    header("Location: carOwner/index.php");
                }
                elseif($json[0]->flag == 3 && $json[0]->password == $password){
                    $_SESSION["adminEmail"] = $email;
                    header("Location: admin/index.html");
                }
                else{
                    $loginfailed = "Username and password are not match"; 
                }    
            }
            elseif($json[0]->Status == 'Pending'){
                $statusError = "Now your account is pending.try again few time later";
            }else{
                $statusError = "your account status is disable.";
            }
        }
    }
?>