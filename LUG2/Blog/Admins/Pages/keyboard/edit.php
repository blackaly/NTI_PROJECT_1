<?php 

require "../../helpers/functions.php";
require '../../helpers/dbConnection.php';
 require "../../helpers/checkForLog.php"; 



$id = Sanitize($_GET["id"], 1); 

if(!validate($id, 2)){
    $_SESSION["messages"] = "Invalid ID"; 
    header("Location: index.php"); 
 }


if($_SERVER['REQUEST_METHOD'] == "POST"){
 
  $errors = [];

 
  $product_name = $_POST["product_name"]; 
  $brand = CleanInputs($_POST["brand"]);
  $key_language = CleanInputs($_POST["key_language"]); 
  $connectivity = CleanInputs($_POST["connectivity"]);
  $compatible_with = CleanInputs($_POST["compatible_with"]);
  $color = CleanInputs($_POST["color"]);
  $model_number = CleanInputs($_POST["model_number"]); 
  
  
 
  if(!validate($brand, 1)){

    $errors['brand'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$brand)){

    $errors['brand'] = "Invalid String";
  }

  
 
 if(!validate($model_number, 1)){

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
   $sql = "UPDATE keyboard SET product_id=$product_name, brand='$brand', key_language='$key_language', connectivity='$connectivity', color='$color', compatible_with='$compatible_with', model_number='$model_number' WHERE id=$id";
   
   $op =  mysqli_query($con, $sql);
    
 


    }



}




  $keyboard_sql = "SELECT * from keyboard where id=$id"; 
  $keyboard_op  = mysqli_query($con, $keyboard_sql);
  $keyboard_fetch = mysqli_fetch_assoc($keyboard_op);   


  $product_sql = "SELECT * from products";
  $product_op = mysqli_query($con, $product_sql);  

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
                    <h2>Add New Keyboard Product</h2>
                    <form method="post" action="edit.php?id=<?php echo $id;?>" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Name</label>
                            <select name="product_name" class="form-control">
                                <?php 
   
                        while($rows = mysqli_fetch_assoc($product_op)){
                    ?>

                                <option value="<?php echo $rows['id'];?>"
                                    <?php if($keyboard_fetch["product_id"] == $rows["id"]){echo "selected"; } ?>>
                                    <?php echo $rows['product_name'];?>
                                </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Brand</label>
                            <input type="text" name="brand" value="<?php echo $keyboard_fetch["brand"] ?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keyboard Language</label>
                            <select name="key_language" class="form-control">
                                <option value="en">en</option>
                                <option value="ar">ar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Connectivity</label>
                            <select name="Connectivity" class="form-control">
                                <option value="wireless">Wireless</option>
                                <option value="wire">Wire</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Color</label>
                            <input type="text" name="color" value="<?php echo $keyboard_fetch["color"]?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Color">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Compatible With</label>
                            <select name="compatible_with" class="form-control">
                                <option value="pc">Laptop</option>
                                <option value="laptop">PC</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Model Number</label>
                            <input type="text" name="model_number" value="<?php echo $keyboard_fetch["model_number"] ?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Model Number">
                        </div>



                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>