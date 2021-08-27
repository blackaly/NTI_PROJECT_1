<?php 

require "../helpers/require.php";

 
   

 if($_SERVER['REQUEST_METHOD'] == "POST"){


    $title = CleanInputs($_POST['title']);

    echo var_dump($title); 

     $erros = [];
    if(!validate($title,1))
    {
      $erros['title'] = "Title Field Required";
    }

    if(count($erros) > 0){

        $_SESSION['messages'] = $erros;
    }else{


     $sql = "insert into users_types (type) values ('$title')";

     $op = mysqli_query($con,$sql);


     if($op){
         header("location: index.php");
     }else{
         $_SESSION['messages'] = ['error try again'];
     }


    }
    mysqli_close($con);


 }



   




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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="container">

                    <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Title">


                            <?php 
                        if(isset($_SESSION["messages"])){
                            foreach($_SESSION["messages"] as $value){
                    ?>
                            <small style="color: red;">
                                <?php echo $value; 
                                } 
                            }
                    ?>
                            </small>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>



            </div>
        </main>




        <?php 

    require '../footer.php';
?>