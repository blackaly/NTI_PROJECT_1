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

  $product_name      = CleanInputs($_POST["product_name"]);
  $product_price     = CleanInputs($_POST["product_price"]);
  $product_price     = Sanitize($product_price, 1);
  $product_condition = CleanInputs($_POST["product_condition"]);
  $supplier_name     = CleanInputs($_POST["supplier_name"]); 
  $oldImage          = $_POST['oldImage'];
  $image_name        = $_FILES['image']['name'];
  $type              = $_FILES['image']['type'];
   


  
  
  
  if(!validate($product_name, 1)){
      
      $errors['product_name'] = " Field Required";
      
    }

  if(!validate($supplier_name, 2)){

    $errors['supplier_id'] = "Invalid Supplier id ";

  }

  if(isset($_FILES['image']['name']) && validate($image,1)  ){

      $nameArray =  explode('/',$type);

      if(count($nameArray) > 0){
        $extension =  strtolower($nameArray[1]);
      }
    }
    
    
    if(!validate($product_condition, 1)){
        
        $errors['product_condition'] = " Field Required";
        
    }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$product_condition)){
        
        $errors['product_condition'] = "Invalid String";
    }
    
    if(!validate($product_price, 2)){
        $errors["product_price"] = "Invalid Number"; 
    }


   if(isset($_FILES['image']['name']) && validate($image, 1)  ){


        $image_temp = $_FILES['image']['tmp_name'];
        $FinalName = rand().time().'.'.$extension;

        $folder = "./upload/";
    
        $finalPath = $folder.$FinalName;
    
        if(file_exists($folder.$oldImage)){
            unlink($folder.$oldImage);
        }

        if(!move_uploaded_file($image_temp, $finalPath)){
        
            $_SESSION['messages'] = ['error in Uploading Image Try Again'];
        }       
       }else{

        $FinalName = $oldImage;
       }

       
            $sql_product = "UPDATE `products` SET `supplier_id`=$supplier_name,`product_name`='$product_name',`product_price`=$product_price,`product_condition`='$product_condition',`product_image`=$image_name WHERE id=$id";
            $product_op =  mysqli_query($con, $sql_product);
            echo mysqli_error($con); 
            exit();  
    
    
}    


 

  
  $product_sql = "SELECT * from products WHERE id=$id";
  $product_op  = mysqli_query($con, $product_sql); 
  $product_fetch = mysqli_fetch_assoc($product_op); 


  $supplier_sql = "SELECT * from suppliers";
  $supplier_op  = mysqli_query($con, $supplier_sql); 


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
                    <h2>Add New Product</h2>
                    <form method="post" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">




                        <div class="form-group">
                            <label for="exampleInputPassword1"></label>
                            <input type="text" name="product_name" value="<?php echo $product_fetch["product_name"];?>"
                                class="form-control" id="exampleInputPassword1" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Price</label>
                            <input type="text" name="memory_size" value="<?php echo $product_fetch["product_price"];?>"
                                class="
                            form-control" id="exampleInputPassword1" placeholder="Product Price">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Condition</label>
                            <select name="product_name" class="form-control">
                                <option value="New"
                                    <?php if($product_fetch["product_conidition"] == "New"){echo "selected"; }?>>
                                    <?php echo $product_fetch['product_condition'];?> </option>
                                <option value="Old">Old</option>
                            </select>
                        </div>

                        <div>
                            <?php 
   
                        while($rows = mysqli_fetch_assoc($supplier_op)){
                    ?>
                            <option value="<?php echo $rows['id'];?>"
                                <?php if($product_fetch["supplier_id"] == $rows["id"]){echo "selected"; } ?>>
                                <?php echo $rows['supplier_name'];?>
                            </option>

                            <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label><br>
                            <input type="file" name="image">
                            <br>
                            <img src="<?php echo $product_fetch['product_image'];?>" width="100px" height="100px">
                        </div>
                        <input Type="hidden" value="<?php echo $product_fetch['product_image']; ?>" name="oldImage">





                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>