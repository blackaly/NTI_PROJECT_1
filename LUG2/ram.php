<!doctype html>
<html class="no-js" lang="zxx">

<!-- shop-3-column31:48-->

<?php 

    require "functions.php"; 
    require "Blog/Admins/helpers/dbConnection.php";
    require "checkForLogin.php";

    $ram_sql = "SELECT ram.*, products.product_name, products.product_price, products.product_condition, products.product_image, suppliers.supplier_name from ram join products on ram.product_id = products.id join suppliers on products.supplier_id = suppliers.id";
    $ram_op  = mysqli_query($con, $ram_sql); 




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
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Shop 3 Column</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!-- Begin Li's Content Wraper Area -->
        <div class="content-wraper pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Li's Banner Area -->
                        <div class="single-banner shop-page-banner">
                            <a href="#">
                                <img src="images/bg-banner/2.jpg" alt="Li's Static Banner">
                            </a>
                        </div>
                        <!-- Li's Banner Area End Here -->
                        <!-- shop-top-bar start -->
                        <div class="shop-top-bar mt-30">
                            <div class="shop-bar-inner">
                                <div class="product-view-mode">
                                    <!-- shop-item-filter-list start -->
                                    <ul class="nav shop-item-filter-list" role="tablist">
                                        <li class="active" role="presentation"><a aria-selected="true"
                                                class="active show" data-toggle="tab" role="tab"
                                                aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a>
                                        </li>
                                        <li role="presentation"><a data-toggle="tab" role="tab"
                                                aria-controls="list-view" href="#list-view"><i
                                                    class="fa fa-th-list"></i></a></li>
                                    </ul>
                                    <!-- shop-item-filter-list end -->
                                </div>
                                <div class="toolbar-amount">
                                    <span>Showing 1 to 9 of 15</span>
                                </div>
                            </div>
                            <!-- product-select-box start -->
                            <div class="product-select-box">
                                <div class="product-short">
                                    <p>Sort By:</p>
                                    <select class="nice-select">
                                        <option value="trending">Relevance</option>
                                        <option value="sales">Name (A - Z)</option>
                                        <option value="sales">Name (Z - A)</option>
                                        <option value="rating">Price (Low &gt; High)</option>
                                        <option value="date">Rating (Lowest)</option>
                                        <option value="price-asc">Model (A - Z)</option>
                                        <option value="price-asc">Model (Z - A)</option>
                                    </select>
                                </div>
                            </div>
                            <!-- product-select-box end -->
                        </div>
                        <!-- shop-top-bar end -->
                        <!-- shop-products-wrapper start -->
                        <div class="shop-products-wrapper">
                            <div class="tab-content">
                                <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                    <div class="product-area shop-product-area">
                                        <div class="row">
                                            <?php while($rows = mysqli_fetch_assoc($ram_op)) { ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                                <!-- single-product-wrap start -->

                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <a
                                                            href="single-product.php?id=<?php echo $rows["product_id"]?>&proudct_name=<?php echo str_replace(" ","-", $rows["product_name"]);?>">
                                                            <img src="<?php echo "./Blog/Admins/Pages/product/" . $rows["product_image"];?> "
                                                                alt="Li's Product Image">
                                                        </a>
                                                        <span
                                                            class="sticker"><?php echo $rows["product_condition"]; ?></span>
                                                    </div>
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a
                                                                        href="product-details.php"><?php echo $rows["supplier_name"]; ?></a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="single-product.php?id=<?php echo $rows["product_id"]?>&proudct_name=<?php echo str_replace(" ","-", $rows["product_name"]);?>"><?php echo $rows["product_name"]; ?></a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span
                                                                    class="new-price"><?php echo $rows["product_price"]; ?>
                                                                    L.E</span>
                                                            </div>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul class="add-actions-link">
                                                                <li class="add-cart active"><a
                                                                        href="shopping-cart.php">Add to cart</a>
                                                                </li>
                                                                <li><a href="#" title="quick view"
                                                                        class="quick-view-btn" data-toggle="modal"
                                                                        data-target="#exampleModalCenter"><i
                                                                            class="fa fa-eye"></i></a></li>
                                                                <li><a class="links-details" href="wishlist.php"><i
                                                                            class="fa fa-heart-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
                                <div class="row">
                                    <div class="col">
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/12.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/11.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/10.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/9.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/8.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/7.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/6.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/5.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/4.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/3.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/2.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row product-layout-list last-child">
                                            <div class="col-lg-3 col-md-5 ">
                                                <div class="product-image">
                                                    <a href="single-product.php">
                                                        <img src="images/product/large-size/1.jpg"
                                                            alt="Li's Product Image">
                                                    </a>
                                                    <span class="sticker">New</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="product-details.php">Graphic Corner</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name"
                                                                href="single-product.php">Hummingbird printed
                                                                t-shirt</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">$46.80</span>
                                                        </div>
                                                        <p>Beach Camera Exclusive Bundle - Includes Two Samsung
                                                            Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire
                                                            Room With Exquisite Sound via Ring Radiator Technology.
                                                            Stream And Control R3 Speakers Wirelessly With Your
                                                            Smartphone. Sophisticated, Modern Desig</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="#">Add to cart</a></li>
                                                        <li class="wishlist"><a href="wishlist.php"><i
                                                                    class="fa fa-heart-o"></i>Add to wishlist</a>
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Quick view</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <p>Showing 1-12 of 13 item(s)</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i>
                                                    Previous</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                                <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
    <!-- Begin Footer Area -->
    <?php require "footer.php"; ?>
    </div>
    <?php require "script.php"; ?>
</body>

<!-- shop-3-column31:48-->

</html>
