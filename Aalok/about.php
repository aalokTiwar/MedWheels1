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
    <title>User_Page</title>
</head>
<body>
<?php include 'header.php';?>
<div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>MedWheels: Your trusted partner in health, dedicated to delivering 
                quality medicines with care and convenience at the core of our commitment.</p>
            <a href="index.php">home</a><span>/ about us</span>
        </div>   
     </div>
     <!-----about us------>
     <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>Hello, welcome to MedWheels, where your health journey begins
                         with care, convenience, and a commitment to your well-being. </h1>
                </div>
                <p>    At MedWheels, we are driven by a commitment to redefine 
                        healthcare,providing seamless access to medicines and personalized 
                        well-being solutions, backed by a passion for your health and 
                        convenience.
                </p>
            </div>
            <div class="img-box">
                <img src="img/about3.webp">
            </div>
        </div>
     </div>
     <!-----features------>
     <div class="features">
        <div class="title">
            <h1>Complete Customer Ideas</h1>
            <span>best features</span>
        </div>
        <div class="row">
            <div class="box">
               <img src="img/twenty1.jpg">
               <h4>24 x 7</h4>
               <p>Online Support 24/7</p>
            </div>
            <div class="box">
               <img src="img/money.jpg">
               <h4>Money Back Gaurantee</h4>
               <p>100% Secure Payment</p>
            </div>
            <div class="box">
               <img src="img/gift.jpg">
               <h4>Special Gift Card</h4>
               <p>Give The Perfect Gift</p>
            </div>
            <div class="box">
               <img src="img/free.jpg">
               <h4>WorldWide Shipping</h4>
               <p>On Order Over ₹999</p>
            </div>

        </div>
     </div>
    

<?php include 'footer.php';?>
<script type="text/javascript" src="script2.js"></script>
</body>
</html>