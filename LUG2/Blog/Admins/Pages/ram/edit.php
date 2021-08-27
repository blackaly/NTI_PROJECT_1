<?php 

require "../../helpers/functions.php";
require '../../helpers/dbConnection.php';
require "../../helpers/checkForLog.php"; 

$id = Sanitize($_GET["id"], 1); 

if(!validate($id, 2)){
    $_SESSION["messages"] = "Invalid ID"; 
 }


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $errors = []; 

  $product_name = $_POST["product_name"]; 
  $model_number = CleanInputs($_POST["model_number"]);
  $memory_size = CleanInputs($_POST["memory_size"]); 
  $memory_speed = CleanInputs($_POST["memory_speed"]);
  $type_of_ram = CleanInputs($_POST["type_of_ram"]);
  $compatible_with = CleanInputs($_POST["compatible_with"]); 
  $number_of_pins = CleanInputs($_POST["number_of_pins"]); 
  $kit_includes = CleanInputs($_POST["kit_includes"]); 

  
  
  

  if(!validate($model_number, 1)){

    $errors['brand'] = " Field Required";

  }
  
 
 if(!validate($memory_size, 1)){

    $errors['model_number'] = " Field Required";

  }
 
   if(!validate($memory_speed, 1)){

    $errors['model_number'] = " Field Required";

  }
   if(!validate($number_of_pins, 1)){

    $errors['model_number'] = " Field Required";

  }
 
 


  if(!validate($product_name, 2)){

    $errors['product_name'] = "Invalid Product id ";

  }


    if(count($errors) > 0){ 

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{

     
      
   // code 
   $sql = "UPDATE ram SET product_id=$product_name, model_number='$model_number', memory_size=$memory_size, memory_speed=$memory_speed, type_of_ram='$type_of_ram', compatible_with='$compatible_with', number_of_pins=$number_of_pins, kit_includes='$kit_includes' WHERE id=$id";
   $op =  mysqli_query($con, $sql);
                                                    

        if($op){
            header("Location: index.php");
        }
    }


}




  # Fetch departments 
  
  $product_sql = "SELECT * from products";
  $product_op  = mysqli_query($con, $product_sql); 

  $ram_sql = "SELECT * from ram where id=$id"; 
  $ram_op  = mysqli_query($con, $ram_sql);
  $ram_fetch = mysqli_fetch_assoc($ram_op);  

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
                    <h2>Add New RAM Product</h2>
                    <form method="post" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Name</label>
                            <select name="product_name" class="form-control">
                                <?php 
   
   while($rows = mysqli_fetch_assoc($product_op)){
       ?>

                                <option value="<?php echo $rows['id'];?>"
                                    <?php if($ram_fetch["product_id"] == $rows["id"]){echo "selected"; }?>>
                                    <?php echo $rows['product_name'];?> </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Model Number</label>
                            <input type="text" name="model_number" value="<?php echo $ram_fetch["model_number"];?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Model Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Memory Size</label>
                            <input type="text" name="memory_size" value="<?php echo $ram_fetch["memory_size"];?>" class="
                                form-control" id="exampleInputPassword1" placeholder="Memory Size">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Memory Speed</label>
                            <input type="text" name="memory_speed" value="<?php echo $ram_fetch["memory_speed"];?>"
                                class="
                                form-control" id="exampleInputPassword1" placeholder="Memory Speed">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Type Of Ram</label>
                            <select name="type_of_ram" class="form-control">
                                <option value="ddr4">DDR4</option>
                                <option value="ddr3">DDR3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Compatible With</label>
                            <input type="text" name="compatible_with"
                                value="<?php echo $ram_fetch["compatible_with"];?>" class="form-control"
                                id="exampleInputPassword1" placeholder="Compatible With">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Number Of Pins</label>
                            <input type="text" name="number_of_pins" value="<?php echo $ram_fetch["number_of_pins"];?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Number Of Pins">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kit Includes</label>
                            <select name="kit_includes" class="form-control">
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                            </select>
                        </div>



                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>