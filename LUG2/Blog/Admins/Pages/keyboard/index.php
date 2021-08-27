<?php 

 require '../../helpers/functions.php';
 require '../../helpers/dbConnection.php';
 require "../../checkForLogin.php"; 


  # fetch all admins Role ... 

  $sql = "select keyboard.*, products.product_name, products.product_price, products.product_condition, suppliers.supplier_name from keyboard join products on keyboard.product_id = products.id join suppliers on products.supplier_id = suppliers.id";
  $op  =  mysqli_query($con,$sql);

   
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


                    <?php 
                        # Dispaly error messages .... 

                        if(isset($_SESSION['messages'])){
                                # code...
                                echo '<li class="breadcrumb-item active">'.$_SESSION['messages'].'</li>';

                                unset($_SESSION['messages']);
                        }else{
                            
                        echo '<li class="breadcrumb-item active">Display Roles</li>';

                        }

                       
                   
                   ?>

                </ol>




                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Condition</th>
                                        <th>Supplier Name</th>
                                        <th>Brand</th>
                                        <th>Keyboard Language</th>
                                        <th>Connectivity</th>
                                        <th>Color</th>
                                        <th>Compatible With</th>
                                        <th>Model Number</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                   
                                    while($rows = mysqli_fetch_assoc($op)){
                                   
                                 ?>
                                    <tr>
                                        <td><?php echo $rows["id"]; ?></td>
                                        <td><?php echo $rows["product_name"]; ?></td>
                                        <td><?php echo $rows["product_price"]; ?></td>
                                        <td><?php echo $rows["product_condition"]; ?></td>
                                        <td><?php echo $rows["supplier_name"]; ?></td>
                                        <td><?php echo $rows["brand"]; ?></td>
                                        <td><?php echo $rows["key_language"]; ?></td>
                                        <td><?php echo $rows["connectivity"]; ?></td>
                                        <td><?php echo $rows["color"]; ?></td>
                                        <td><?php echo $rows["compatible_with"]; ?></td>
                                        <td><?php echo $rows["model_number"]; ?></td>


                                        <td>
                                            <a href='delete.php?id=<?php echo $rows["id"];?>'
                                                class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit.php?id=<?php echo $rows["id"];?>'
                                                class='btn btn-primary m-r-1em'>Edit</a>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>




        <?php 

    require '../../footer.php';
?>