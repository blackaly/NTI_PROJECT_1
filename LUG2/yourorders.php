<!doctype html>
<html class="no-js" lang="zxx">

<!-- shopping-cart31:32-->

<?php 
    require "functions.php"; 
    require "Blog/Admins/helpers/dbConnection.php";
    require "checkForLogin.php";
    
    $user_id = $_SESSION["user"]["users_id"]; 


    $order_sql   = "SELECT customer_order.id, products.product_name, products.product_price, products.product_condition, products.product_image, users.users_id from products join customer_order on customer_order.product_id = products.id join users on users_id = $user_id";
    $order_op    = mysqli_query($con, $order_sql); 



    require "headTag.php"; 

?>

< <body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <?php require "headerTag.php"; ?>
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Your Orders</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="li-product-remove">remove</th>
                                            <th class="li-product-thumbnail">images</th>
                                            <th class="cart-product-name">Order ID</th>
                                            <th class="li-product-price">Product Name</th>
                                            <th class="li-product-quantity">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <?php while($order_fetch = mysqli_fetch_assoc($order_op)){ ?>

                                            <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>
                                            <td class="li-product-thumbnail"><a href="#"><img
                                                        src="<?php echo "./Blog/Admins/Pages/product/" . $order_fetch["product_image"]; ?>">
                                                </a>
                                            </td>
                                            <td class="quantity">
                                                <label><?php echo $order_fetch["id"] ?></label>

                                            </td>
                                            <td class="li-product-name"><a
                                                    href="#"><?php echo $order_fetch["product_name"];?></a></td>
                                            <td class="li-product-price"><span
                                                    class="amount"><?php echo $order_fetch["product_price"];?></span>
                                            </td>
                                            <td class="quantity">
                                                <label><?php echo $quantity ?></label>

                                            </td>

                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
        <!-- Begin Footer Area -->
        <?php require "footer.php"; ?>
    </div>
    <?php require "script" ;?>
    </body>

    <!-- shopping-cart31:32-->

</html>