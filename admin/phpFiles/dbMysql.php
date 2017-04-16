<?php 

$conn = mysqli_connect("localhost", "root", "root", "find_My_Mechanic");
    if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
    }

?>