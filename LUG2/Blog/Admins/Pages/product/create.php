<?php 

require "../../helpers/functions.php";
require '../../helpers/dbConnection.php';
 require "../../helpers/checkForLog.php"; 

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $errors = [];
  $status = true;

  $product_name      = CleanInputs($_POST["product_name"]);
  $product_price     = CleanInputs($_POST["product_price"]);
  $product_price     = Sanitize($product_price, 1);
  $product_condition = CleanInputs($_POST["product_condition"]);
  $supplier_name     = CleanInputs($_POST["supplier_name"]); 

  
  
  
  if(!validate($product_name, 1)){
      
      $errors['product_name'] = " Field Required";
      
    }

  if(!validate($supplier_name, 2)){

    $errors['supplier_id'] = "Invalid Supplier id ";

  }
    
    
    if(!validate($product_condition, 1)){
        
        $errors['product_condition'] = " Field Required";
        
    }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$product_condition)){
        
        $errors['product_condition'] = "Invalid String";
    }
    
    if(!validate($product_price, 2)){
        $errors["product_price"] = "Invalid Number"; 
    }


    if(!empty($_FILES['image']['name'])){



      $image_name = $_FILES['image']['name'];
      $image_temp = $_FILES['image']['tmp_name'];
      $image_type = $_FILES['image']['type'];

   

      $nameArray =  explode('/',$image_type);

      $extension =  strtolower($nameArray[1]);
      
      $finalName = rand().time().'.'.$extension;
      $allowed_extension = array('png','jpg','jpeg','pdf'); 


      if(in_array($extension,$allowed_extension)){

           $folder = "./upload/";

           $finalPath = $folder.$finalName;
           $status = move_uploaded_file($image_temp, $finalPath);

          if($status){
            $errors["image"] = "Filed Uploaded"; 
          }


      }else{

       $errors["image"] = "Field does not uploaded";
      }

       }else{

        $errors["image"] = "File required"; 
       }    


    if($status){

            // code 
            $sql_product = "INSERT INTO products (supplier_id, product_name, product_price, product_condition, product_image) VALUES ('$supplier_name', '$product_name', $product_price, '$product_condition', '$finalPath')";
            
            $product_op =  mysqli_query($con, $sql_product);
            
            echo mysqli_error($con); 

      
         
    }     
    
    
}    




  # Fetch departments 
  
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
                    <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                        enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input type="number" name="product_price" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Product Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Condition</label>
                            <select name="product_condition" class="form-control">
                                <option value="old">Old</option>
                                <option value="new">New</option>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="exampleInputPassword1">Supplier Name</label>
                            <select name="supplier_name" class="form-control">
                                <?php 
   
                        while($rows = mysqli_fetch_assoc($supplier_op)){
                    ?>

                                <option value="<?php echo $rows['id'];?>"> <?php echo $rows['supplier_name'];?>
                                </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Add an Image</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </main>




        <?php 

    require '../../footer.php';
?>