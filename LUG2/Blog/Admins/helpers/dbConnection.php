<?php 

  $db_server = "localhost";
  $db_name = "e_commerce";
  $db_user = "root";
  $db_password = "";


    $con =  mysqli_connect($db_server,$db_user,$db_password,$db_name);

    if(!$con){

        die("Error : ".mysqli_connect_error());
    }


?>