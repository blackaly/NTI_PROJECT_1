<?php 

require '../../helpers/functions.php';
require '../../helpers/dbConnection.php';
 require "../../checkForLogin.php"; 

$id = Sanitize($_GET['id'], 1);

 if(!validate($id, 2)){
 
     $message = "Invalid Id";

 }else{

   $sql = "DELETE FROM suppliers WHERE id = $id";
   $op  = mysqli_query($con, $sql);

   if($op){
       $message = "item Deleted";
       header("Location: index.php");
   }else{
       
       $message = "error try again";
       $_SESSION['messages'] = $message;
    header("Location: index.php");
   }

   


 }

?>