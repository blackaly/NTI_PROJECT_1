<?php 

 require '../../helpers/functions.php';
 require '../../helpers/dbConnection.php';
 require "../../helpers/checkForLog.php"; 


  $sql = "select * from customer_order";
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
                                        <th>Id</th>
                                        <th>Customer_Id</th>
                                        <th>Payment Id</th>
                                        <th>Product Id</th>
                                        <th>quantity</th>
                                        <th>Order Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                   
                                    while($rows = mysqli_fetch_assoc($op)){
                                   
                                 ?>
                                    <tr>
                                        <td><?php echo $rows["id"]; ?></td>
                                        <td><?php echo $rows["customer_id"]; ?></td>
                                        <td><?php echo $rows["payment_id"]; ?></td>
                                        <td><?php echo $rows["product_id"]; ?></td>
                                        <td><?php echo $rows["quantity"]; ?></td>
                                        <td><?php echo $rows["order_price"]; ?></td>

                                        <td>
                                            <a href='delete.php?id=<?php echo $rows["id"];?>'
                                                class='btn btn-danger m-r-1em'>Delete</a>

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