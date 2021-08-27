<?php 

require "../helpers/require.php";



$id = Sanitize($_GET["id"], 1); 

if(!validate($id, 2)){
    $_SESSION["messages"] = "Invalid ID"; 
    header("Location: index.php"); 
 }


if($_SERVER['REQUEST_METHOD'] == "POST"){
 
  $errors = [];

  $admin_name   = CleanInputs($_POST['admin_name']);
  $admin_email  = CleanInputs($_POST['admin_email']);
  $admin_type   =  Sanitize($_POST['admin_type'], 1);

  if(!validate($admin_name, 1)){

    $errors['Name'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$admin_name)){
  

    $errors['Name'] = "Invalid String";
  }



  if(!validate($admin_email, 1)){

   
    $errors['Email'] = " Field Required";

  }elseif(!validate($admin_email, 3)){
     $errors['Email'] = "Invalid Email";
    
  }


  if(!validate($admin_type, 2)){

    $errors['type'] = "Invalid Admin id ";

  }


    if(count($errors) > 0){

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{
         

        $sql = "UPDATE admins SET admin_name='$admin_name', admin_email='$admin_email', admin_type=$admin_type WHERE id=$id ";
        $op =  mysqli_query($con, $sql);
        echo mysqli_error($con); 

        if($op){

            echo 'data Inserted';
        }else{
            echo 'Error Try Again';
        }


    }



}





  $sql = "SELECT * from admin_types";
  $op  = mysqli_query($con,$sql); 


  $admin_sql = "SELECT * from admins where id = $id"; 
  $admin_op  = mysqli_query($con, $admin_sql);
  $admin_fetch = mysqli_fetch_assoc($admin_op);   


  mysqli_close($con);

require '../header.php';
require "../nav.php";
?>



<div id="layoutSidenav">

    <?php 
   require '../sidNav.php';
?>
    <div id="layoutSidenav_content">


        <main>


            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="container">
                    <h2>Add New User</h2>
                    <form method="post" action="edit.php?id=<?php echo $id ?>" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="admin_name" value="<?php echo $admin_fetch["admin_name"]?>"
                                class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="admin_email" value="<?php echo $admin_fetch["admin_email"]?>"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Admin Type</label>
                            <select name="admin_type" class="form-control">
                                <?php 
   
                        while($rows = mysqli_fetch_assoc($op)){
                    ?>

                                <option value="<?php echo $rows['id'];?>"
                                    <?php if($rows["id"] == $users_fetch["admin_type"]){echo "selected";} ?>>
                                    <?php echo $rows["title"]; ?>
                                </option>


                                <?php } ?>

                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../footer.php';
?>