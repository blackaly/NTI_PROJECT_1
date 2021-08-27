<?php 

 if(!($_SESSION['user']['admin_type'] == 1)){

     header("Location: ".url('Pages/product/index.php'));

 }



?>