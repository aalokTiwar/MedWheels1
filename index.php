<?php
    
    @include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)){
        header('location:login.php');
    }

    if (isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
    //adding product in wishlist
    if (isset($_POST['add_to_wishlist'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE name= '$product_name' AND user_id = '$user_id'") or die('query failed');
        $cart_num = mysqli_query($conn,"SELECT * FROM `cart` WHERE name= '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($wishlist_number)>0) {
        $message[]='product alredy exist in wishlist';
        }else  if (mysqli_num_rows($cart_num)>0) {
            $message[]='product alredy exist in cart';
        }else{
            mysqli_query($conn,"INSERT INTO `wishlist`(`user_id`, `pid`,`name`,`price`,`image`) VALUES('$user_id',
            '$product_id','$product_name','$product_price','$product_image')");
            $message[]='product succesfully added in your wishlist'; 
        }
    }
     //adding product in cart
     if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $cart_num = mysqli_query($conn,"SELECT * FROM `cart` WHERE name= '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($cart_num)>0) {
            $message[]='product alredy exist in cart';
        }else{
            mysqli_query($conn,"INSERT INTO `cart`(`user_id`, `pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id',
            '$product_id','$product_name','$product_price','$product_quantity','$product_image')");
            $message[]='product succesfully added in your cart'; 
        }
    }
?>
<style type="text/css">

    <?php
        include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <title>User_Page</title>
</head>
<body>
<?php include 'header.php';?>
<div class="container-field">
    <div class="hero-slider">
        <div class="slider-item">
        <img src="img/background.jpg">
            <div class="slider-caption">
                <span>Branded Medicine</span>
                <h1>Better Discount <br>Medicine</h1>
                <p>Discover a digital pharmacy experience designed to prioritize your well-being, 
                    offering a comprehensive range of medicines, personalized profiles,
                     and hassle-free prescription uploads for a healthier tomorrow.
                </p>
                <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
</div>
<div class="line"></div>
<div class="services">
    <div class="row">
        <div class="box">
            <img src="img/free.jpg">
             <div>
                <h1>Free Shipping Fast</h1>
                <p>Enjoy worry-free shopping with our medicine delivery service - now offering 
                    free shipping for a seamless and affordable healthcare experience.</p>
             </div>
        </div>
        <div class="box">
            <img src="img/money.jpg">
             <div>
                <h1>Money back & Gaurantee</h1>
                <p>Rest easy with our satisfaction guarantee - your peace of mind is our priority,
                     backed by a hassle-free money-back policy.
                  </p>
             </div>
        </div>
        <div class="box">
            <img src="img/twenty1.jpg">
             <div>
                <h1>Online Support 24/7t</h1>
                <p>Experience uninterrupted assistance with our round-the-clock online support,
                     ensuring help is just a click away whenever you need it.</p>
             </div>
        </div>
    </div>
</div>
<div class="line2"></div>
<div class="story">
    <div class="row">
        <div class="box">
            <span>our story</span>
            <h1>premium packging of medicne</h1>
            <p>At MedWheels, we redefine healthcare accessibility with our user-centric website.
                 Navigate seamlessly through our comprehensive range of medicines, place orders 
                 effortlessly, and experience the assurance of timely deliveries. Our commitment
                  to your well-being extends beyond transactions — it's a journey of trust, 
                  convenience, and personalized care. Explore MedWheels, where every click
                   is a step towards a healthier, happier you.
            </p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <img src="img/medicine..jpg">
        </div>
    </div>
</div>
<div class="line"></div>
<!----discover section------>
<div class="line2"></div>
<div class="discover">
    <div class="detail">
        <h1 class ="title">Premium medicine </h1>
        <span>Buy Now save 30% off!</span>
        <p>Elevate your well-being with MedWheels - seize our exclusive offer for affordable healthcare delivered to your door.</p>
        <a href="shop.php" class="btn">discover now</a>
    </div>
    <div class="img-box">
        <img src="img/discover.jpg">
    </div>
</div>
<div class="line3"></div>


<?php include 'homeshop.php';?>
<?php include 'footer.php';?>

<script type="text/javascript" src="script2.js"></script>
</body>
</html>