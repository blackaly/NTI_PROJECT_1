<?php 

require "../helpers/require.php";

$id = Sanitize($_GET['id'],1);


 if(!validate($id,2)){
 
     $message = "Invalid Id";

 }else{

   $sql = "delete from users_types where id = $id";
   $op  = mysqli_query($con,$sql);

   if($op){
       $message = "item Deleted";
   }else{
       $message = "error try again";
   }

   
    $_SESSION['messages'] = $message;

    header("Location: index.php");


 }

?>