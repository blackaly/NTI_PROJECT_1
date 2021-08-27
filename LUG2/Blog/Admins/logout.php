<?php 

   require './helpers/functions.php';

   session_destroy();
   unset($_SESSION["user"]);

   header("Location: ".url("login.php"));


?>