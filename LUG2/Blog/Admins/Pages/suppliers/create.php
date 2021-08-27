<?php 

require "../../helpers/functions.php";
require '../../helpers/dbConnection.php';
 require "../../checkForLogin.php"; 



if($_SERVER['REQUEST_METHOD'] == "POST"){

  $errors = [];

  $name  = CleanInputs($_POST['name']);
  

  if(!validate($name, 1)){

    $errors['Name'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$name)){

    $errors['Name'] = "Invalid String";
  }


    if(count($errors) > 0){

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{

   // code 
   $sql = "insert into suppliers (supplier_name) values ('$name')";

    $op =  mysqli_query($con, $sql);

    if($op){

        echo 'data Inserted';
    }else{
        echo 'Error Try Again';

      // echo  mysqli_error($con);


    }


    }

   


}



require '../../header.php';
require "../../nav.php";
?>



<div id="layoutSidenav">

    <?php 
   require '../../sidNav.php';
?>
    <div id="layoutSidenav_content">


        <main>


            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="container">
                    <h2>Add New Supplier</h2>
                    <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Name">
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>