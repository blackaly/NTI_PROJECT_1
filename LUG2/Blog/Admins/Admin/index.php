<?php 

require "../helpers/require.php";


  $sql = "select admins.*, admin_types.title as title from admins join admin_types on admins.admin_type = admin_types.id";
  $op  =  mysqli_query($con,$sql);

   
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
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                   
                                    while($rows = mysqli_fetch_assoc($op)){
                                   
                                 ?>
                                    <tr>
                                        <td><?php echo $rows["id"]; ?></td>
                                        <td><?php echo $rows['admin_name'];?></td>
                                        <td><?php echo $rows['admin_email'];?></td>
                                        <td><?php echo $rows['title'];?></td>


                                        <td>
                                            <a href='delete.php?id=<?php echo $rows["id"];?>'
                                                class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit.php?id=<?php echo $rows["id"];?>'
                                                class='btn btn-primary m-r-1em'>Edit</a>
                                            <a href='create.php' class='btn btn-primary m-r-1em'>Create</a>
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

    require '../footer.php';
?>