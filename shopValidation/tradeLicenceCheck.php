<?php
function getJSONFromDB($sql){
            $conn = mysqli_connect("localhost", "root", "","find_my_mechanic");
            $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
            $arr=array();
            while($row = mysqli_fetch_assoc($result)) {
                $arr[]=$row;
            }
            return json_encode($arr);
        }

        $sql="select ShopTradeLicence from shopowner where ShopTradeLicence = '".$_REQUEST['shopOwnerTDN']."'";
        $jsonData= getJSONFromDB($sql);
        $json=json_decode($jsonData);
        if($jsonData != '[]'){
        	echo $json[0]->ShopTradeLicence;
        }
?>