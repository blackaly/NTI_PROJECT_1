<?php 

    require "functions.php"; 
    require "Blog/Admins/helpers/dbConnection.php";
 




    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $check_for_errors = []; 

        switch($_POST["form"]){
            case 1: 
                
          
                $email    = clearUserInput($_POST["email"]);
                $password = $_POST["password"];  
                              
                if(!userValidation($email, 'e')){
                    $check_for_errors["email"] = "Field Required";
                     
                       
                }else if(!userValidation($email, 'm')){
                    $check_for_errors["email"]  = "Not correct Email";
                    
                          
                }

                if(!userValidation($password, 'e')){
                    $check_for_errors["password"] = "Field Required";
                    
                }else{
                    
                    $password = sha1($password);
                   
                    $sql = "select * from users where users_email = '$email' and users_password='$password'";
                    $op = mysqli_query($con, $sql); 
                    $check_for_rows = mysqli_num_rows($op);

                    if($check_for_rows == 1){
                        $data = mysqli_fetch_assoc($op);
                        $_SESSION['user'] = $data;
                        header("Location: index.php");
                    }else{
                        $check_for_errors["invalid"] = "Invalid email or password";  
                    }
                    mysqli_close(); 
                
                break;    
        }

            case 2: 
                    $name     = clearUserInput($_POST["name"]); 
                    $email    = clearUserInput($_POST["email"]);
                    $email    = Sanitize($email, 'e'); 
                    
                    $password = $_POST["password"]; 
                    $confirm  = $_POST["confirm"]; 

                    if(!userValidation($name, 'e')){
                        $check_for_errors["name"] = "Field Required"; 
                    }else if(!preg_match("/^[a-zA-Z\s*']+$/", $name)){
                        $check_for_errors["name"] = "Invalid Name"; 
                    }

                    if(!userValidation($email, 'e')){
                        $check_for_errors["email"] = "Field Required";
                    }else if(!userValidation($email, 'm')){
                        $check_for_errors["email"] = "Invalid Email"; 
                    }

                    if(!userValidation($password, 'e')){
                        $check_for_errors["password"] = "Field Required"; 
                    }else if (!userValidation($password, 'p')){
                        $check_for_errors["password"] = "Password Length is less than 6";
                    }

                    if (!userValidation($confirm, 'e')){
                        $check_for_errors["confirm"] = "Field Required"; 
                    }else if ($confirm != $password){
                        $check_for_errors["confirm"] = "Password doesn't match"; 
                    }
                    else {
                        $password = sha1($password);

                        $sql = "INSERT INTO users (users_name, users_email, users_password, users_type) VALUES ('$name', '$email', '$password', 1)";
                        $op = mysqli_query($con, $sql);
                        
                        if($op){
                            header("Location: shop-3-column.php");
                        }else{
                            $check_for_errors["invalid"] = "Something Wrong in your data"; 
                        }


                    }
                    mysqli_close();


    }
}



?>




<!doctype html>
<html class="no-js" lang="zxx">

<!-- login-register31:27-->
<?php require "headTag.php"; ?>

<body>

    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <?php require "headerTag.php"; ?>
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Login Register</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!-- Begin Login Content Area -->
        <div class="page-section mb-60">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                        <!-- Login Form s-->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="login-form">
                                <h4 class="login-title">Login</h4>
                                <div class="row">
                                    <div class="col-md-12 col-12 mb-20">
                                        <input type="hidden" name="form" value=1>
                                    </div>
                                    <div class="col-md-12 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input name="email" class="mb-0" type="email" placeholder="Email Address">
                                        <small style="color: red;">
                                            <?php 
                                            
                                                        if(isset($check_for_errors) && $_POST['form'] == 1){
                                                            echo $check_for_errors["email"];
                                                        }
                                            ?>
                                        </small>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Password</label>
                                        <input name="password" class="mb-0" type="password" placeholder="Password">
                                        <small style="color: red;">
                                            <?php 
                                                            if(isset($check_for_errors) && $_POST["form"] == 1 ){
                                                                echo $check_for_errors["password"];
                                                            }
                                            ?>
                                        </small>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="register-button mt-0">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="login-form">
                                <h4 class="login-title">Register</h4>
                                <small style="color: red;">

                                    <?php 
                                                            if(isset($check_for_errors)){
                                                                echo $check_for_errors["password"];
                                                            }
                                    ?>
                                </small>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-20">
                                        <input type="hidden" name="form" value=2>
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label>Your Name</label>
                                        <input name="name" class="mb-0" type="text" placeholder="You Name">
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label>Email Address*</label>
                                        <input name="email" class="mb-0" type="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Password</label>
                                        <input name="password" class="mb-0" type="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Confirm Password</label>
                                        <input name="confirm" class="mb-0" type="password"
                                            placeholder="Confirm Password">
                                    </div>
                                    <div class="col-12">
                                        <button class="register-button mt-0">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Content Area End Here -->
        <!-- Begin Footer Area -->
        <?php require "footer.php"; ?>
    </div>
    <?php require "script.php"; ?>
</body>

<!-- login-register31:27-->

</html>
