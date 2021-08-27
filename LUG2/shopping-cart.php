<!doctype html>
<html class="no-js" lang="zxx">

<!-- shopping-cart31:32-->

<?php 
    require "functions.php"; 
    require "Blog/Admins/helpers/dbConnection.php";
    require "checkForLogin.php";

     $order_sql = null;
     $order_op  = null; 
    $order_fetch = null;
    $total = null; 


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
                        <li class="active">Shopping Cart</li>
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
                                            <th class="cart-product-name">Product</th>
                                            <th class="li-product-price">Unit Price</th>
                                            <th class="li-product-quantity">Quantity</th>
                                            <th class="li-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($_SESSION["product_info"] as $key => $value){ 
                                            foreach($value as $id => $quantity){
                                        ?>

                                        <tr>
                                            <?php 
                                                $order_sql = "SELECT * from products WHERE id=$id";
                                                $order_op = mysqli_query($con, $order_sql); 
                                                $order_fetch = mysqli_fetch_assoc($order_op); 
                                            ?>
                                            <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>
                                            <td class="li-product-thumbnail"><a href="#"><img
                                                        src="<?php echo "./Blog/Admins/Pages/product/" . $order_fetch["product_image"]; ?>">
                                                </a>
                                            </td>
                                            <td class="li-product-name"><a
                                                    href="#"><?php echo $order_fetch["product_name"];?></a></td>
                                            <td class="li-product-price"><span
                                                    class="amount"><?php echo $order_fetch["product_price"];?></span>
                                            </td>
                                            <td class="quantity">
                                                <label><?php echo $quantity ?></label>

                                            </td>
                                            <td class="product-subtotal"><span class="amount">
                                                    <?php echo $order_fetch["product_price"] * $quantity?>
                                                    <?php $total += $order_fetch["product_price"] * $quantity; ?>
                                                </span></td>
                                        </tr>

                                        <?php }}?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update Cart" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Total <span><?php echo $total ;?></span></li>
                                        </ul>
                                        <a href="checkout.php">Proceed to checkout</a>
                                    </div>
                                </div>
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
