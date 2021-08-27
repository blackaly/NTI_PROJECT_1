<?php 

require "../../helpers/functions.php";
require '../../helpers/dbConnection.php';
 require "../../checkForLogin.php"; 



$id = Sanitize($_GET["id"], 1); 

if(!validate($id, 2)){
    $_SESSION["messages"] = "Invalid ID"; 
    header("Location: index.php"); 
 }


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
         

        $sql = "UPDATE suppliers SET supplier_name='$name' WHERE id=$id ";

        $op =  mysqli_query($con, $sql);

        if($op){

            echo 'data Inserted';
        }else{
            echo 'Error Try Again';
        }


    }



}




  $supplier_sql = "SELECT * from suppliers where id=$id"; 
  $supplier_op  = mysqli_query($con, $supplier_sql);
  $supplier_fetch = mysqli_fetch_assoc($supplier_op);   


  mysqli_close($con);

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
                    <form method="post" action="edit.php?id=<?php echo $id ?>" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" value="<?php echo $supplier_fetch["supplier_name"]?>"
                                class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>