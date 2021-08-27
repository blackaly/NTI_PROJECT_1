<?php 



require "../helpers/require.php";



if($_SERVER['REQUEST_METHOD'] == "POST"){

  $errors = [];

  $admin_name     = CleanInputs($_POST['name']);
  $admin_email    = CleanInputs($_POST['email']);
  $admin_password = $_POST['password'] ;
  $admin_type     =  Sanitize($_POST['admin_type'], 1);

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


  if(!validate($admin_password, 1)){

    $errors['Password'] = " Field Required";

  }elseif(!validate($admin_password, 4)){

    $errors['Password'] = "Invalid Length";
  }


  if(!validate($admin_type, 2)){

    $errors['admin_type'] = "Invalid Admin id ";

  }


    if(count($errors) > 0){

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{

   $admin_password = sha1($admin_password);

   $sql = "insert into admins (admin_name, admin_email, admin_password, admin_type) values ('$admin_name','$admin_email','$admin_password',$admin_type)";

    $op =  mysqli_query($con, $sql);

    if($op){

        echo 'data Inserted';
    }else{
        echo 'Error Try Again';



    }


    }

   
}




  $sql = "select * from admin_types";
  $op  = mysqli_query($con,$sql); 

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
                    <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>




                        <div class="form-group">
                            <label for="exampleInputPassword1">Admin Type</label>
                            <select name="admin_type" class="form-control">
                                <?php 
   
                        while($rows = mysqli_fetch_assoc($op)){
                    ?>

                                <option value="<?php echo $rows['id'];?>"> <?php echo $rows['title'];?> </option>

                                <?php } ?>

                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../footer.php';
?>