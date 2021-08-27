<?php 

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';
 require "../../helpers/checkForLog.php"; 

$id = Sanitize($_GET['id'], 1);

 if(!validate($id, 2)){
 
     $message = "Invalid Id";

 }else{

   $sql = "DELETE FROM keyboard WHERE id=$id";
   $op  = mysqli_query($con, $sql);

   if($op){
       $message = "item Deleted";
       header("Location: index.php");
   }else{
       
       $message = "error try again";
       $_SESSION['messages'] = $message;
   }

   


 }

?>