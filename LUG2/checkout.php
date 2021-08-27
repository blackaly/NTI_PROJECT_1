<!doctype html>
<html class="no-js" lang="zxx">

<!-- checkout31:27-->

<?php 

    
    require "functions.php"; 
    require "Blog/Admins/helpers/dbConnection.php";
    require "checkForLogin.php"; 

    $order_sql = null;
    $order_op  = null; 
    $order_fetch = null;
    $total = 0; 


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $customer_first_name = clearUserInput($_POST["customer_first_name"]);
        $customer_last_name = clearUserInput($_POST["customer_last_name"]);
        $customer_city = clearUserInput($_POST["customer_city"]);
        $customer_county = clearUserInput($_POST["customer_county"]);
        $customer_street = clearUserInput($_POST["customer_street"]);

        $customer_building = clearUserInput($_POST["customer_building"]);
        $customer_building = Sanitize($customer_building, 's'); 
        
        $customer_phone = clearUserInput($_POST["customer_phone"]);
        $customer_phone = Sanitize($customer_phone, 's');


        if(!userValidation($customer_first_name, 'e')){

            $errors['customer_first_name'] = " Field Required";

        }else if(!preg_match("/^[a-zA-Z\s*']+$/",$customer_first_name)){
            $errors['customer_first_name'] = " Invalid Input";

        }


        if(!userValidation($customer_last_name, 'e')){

            $errors['customer_last_name'] = " Field Required";

        }else if(!preg_match("/^[a-zA-Z\s*']+$/",$customer_last_name)){
            $errors['customer_last_name'] = " Invalid Input";

        }

        

        if(!userValidation($customer_city, 'e')){

            $errors['customer_city'] = " Field Required";

        }else if(!preg_match("/^[a-zA-Z\s*']+$/",$customer_city)){
            $errors['customer_city'] = " Invalid Input";

        }



        if(!userValidation($customer_county, 'e')){

            $errors['customer_county'] = " Field Required";

        }else if(!preg_match("/^[a-zA-Z\s*']+$/",$customer_county)){
            $errors['customer_county'] = " Invalid Input";

        }



        if(!userValidation($customer_street, 'e')){

            $errors['customer_street'] = " Field Required";

        }

        
        if(!userValidation($customer_building, 'e')){

            $errors['customer_building'] = " Field Required";

        }else if(!userValidation($customer_building, 'n')){
            $errors["customer_building"] = "Invalid Number"; 
        }
        
        
        if(!userValidation($customer_phone, 'e')){

            $errors['customer_phone'] = " Field Required";

               


        }else if(!userValidation($customer_phone, 'n')){
            $errors['customer_phone'] = "Invalid Number";
        }
     

         
        else{

     
                $customer_details_sql = "INSERT INTO `customer_details`(`customer_first_name`, `customer_last_name`, `customer_city`, `customer_county`, `customer_street`, `customer_building`, `customer_phone`) VALUES ('$customer_first_name', '$customer_last_name', '$customer_city', '$customer_county', '$customer_street', $customer_building, $customer_phone)";
                $customer_details_op = mysqli_query($con, $customer_details_sql); 
                
                 $customer_order_id = $_SESSION['user']['users_id'];
                 $order_price = $_SESSION["total"]; 

                if($customer_details_op){
                   
                    $customer_address_sql = "INSERT INTO `customer_address`(`customer_id`, `address_id`) VALUES ( $customer_order_id, $customer_order_id)";
                    $customer_address_op = mysqli_query($con, $customer_address_sql);
                }   

                if($customer_details_op){
                    foreach($_SESSION["product_info"] as $value){
                        foreach($value as $id => $quantity){
                          
                            $customer_order_product_sql = "INSERT INTO `customer_order`(`customer_id`, `payment_id`, `product_id`, `quantity`, `order_price`) VALUES ($customer_order_id, 1, $id, $quantity, $order_price)"; 
                            $customer_order_product_op = mysqli_query($con, $customer_order_product_sql);
                        }
                    }
                }
            }
            
           

            mysqli_close($con);

            
    }

    require "headTag.php"; 

?>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <?php require "headerTag.php"; ?>

        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!--Checkout Area Strat-->
        <div class="checkout-area pt-60 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input placeholder="First Name" name="customer_first_name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input placeholder="Last Name" name="customer_last_name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input placeholder="Street address" name="customer_street" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="City" name="customer_city">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input placeholder="County" type="text" name="customer_county">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Building Number <span class="required">*</span></label>
                                            <input placeholder="Building Number" name="customer_building" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Phone" name="customer_phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="different-address"></div>
                            </div>
                            <div class="order-button-payment">
                                <input value="Place order" type="submit">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($_SESSION["product_info"] as $key => $value){ 
                                            foreach($value as $id => $quantity){
                                               
                                        ?>

                                        <?php 
                                                $order_sql = "SELECT product_name, product_price from products WHERE id=$id";
                                                $order_op = mysqli_query($con, $order_sql); 
                                                $order_fetch = mysqli_fetch_assoc($order_op);
                                        ?>

                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <?php echo $order_fetch["product_name"]; ?><strong
                                                    class="product-quantity"> × <?php echo $quantity ?></strong></td>
                                            <td class="cart-product-total"><span class="amount"><?php echo $order_fetch["product_price"];
                                                        $_SESSION["total"] += $order_fetch["product_price"];
                                                        $total += $order_fetch["product_price"]; 

                                                        if($_SESSION["total"] != $total){
                                                            unset($_SESSION["total"]);
                                                            $_SESSION["total"] = $total; 
                                                        }
                                                    ?>
                                                    L.E</span></td>
                                        </tr>
                                        <?php }} ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"><?php echo $_SESSION["total"]; ?>
                                                        L.E</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Direct Bank Transfer.
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order won’t be shipped
                                                        until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                        Cheque Payment
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order won’t be shipped
                                                        until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse"
                                                        data-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">
                                                        PayPal
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order won’t be shipped
                                                        until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Checkout Area End-->
        <?php require "footer.php"; ?>

    </div>
    <?php require "script.php"; ?>
</body>

<!-- checkout31:27-->

</html>