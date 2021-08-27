<?php 

 require '../../helpers/functions.php';
 require '../../helpers/dbConnection.php';
 require "../../helpers/checkForLog.php"; 




  $sql = "SELECT ram.*, products.product_name, products.product_price, products.product_condition, suppliers.supplier_name from ram join products on ram.product_id = products.id join suppliers on products.supplier_id = suppliers.id";
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

                        if(isset($_SESSION['messages'])){
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
                                        <th>Model Number</th>
                                        <th>Memory Size</th>
                                        <th>Memory Speed</th>
                                        <th>Type Of Ram</th>
                                        <th>Compatible With</th>
                                        <th>Number of Pins</th>
                                        <th>kit includes</th>



                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    while($rows = mysqli_fetch_assoc($op)){
                                   
                                 ?>
                                    <tr>
                                        <td><?php echo $rows["id"]; ?></td>
                                        <td><?php echo $rows["product_name"]; ?></td>
                                        <td><?php echo $rows["model_number"]; ?></td>
                                        <td><?php echo $rows["memory_size"]; ?></td>
                                        <td><?php echo $rows["memory_speed"]; ?></td>
                                        <td><?php echo $rows["type_of_ram"]; ?></td>
                                        <td><?php echo $rows["compatible_with"]; ?></td>
                                        <td><?php echo $rows["number_of_pins"]; ?></td>
                                        <td><?php echo $rows["kit_includes"]; ?></td>



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