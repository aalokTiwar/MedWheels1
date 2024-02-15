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
  if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $number = mysqli_real_escape_string($conn,$_POST['number']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    
    $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE name= '$name' AND email='$email' AND 
    $number = '$number' AND message='$message'") or die('query failed');
    if (mysqli_num_rows($select_message)>0) {
        echo 'message already send';
    }else{
        mysqli_query($conn, "INSERT INTO `messages`(`user_id`,`name`,`email`,`number`,`message`) VALUES('$user_id','$name','$email','$number',
        '$message')") or die('query failed');
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
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdeliver.net/npm/bootstrap-icons@1.9.1/front/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>User_Page</title>
</head>
<body>
<?php include 'header.php';?>
<div class="banner">
        <div class="detail">
            <h1>contact</h1>
            <p>Connect with us effortlessly on our Contact Page, because at MedWheels, 
                your inquiries and health concerns are our top priority.</p>
            <a href="index.php">home</a><span>/ contact</span>
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
<div class="line4"></div>
 <div class="form-container">
    <h1 class="title">leave a message</h1>
  <div class="line"></div>
  <form method="post">
    <div class="input-field">
        <label>your name</label><br>
        <input type="text" name="name">
    </div>
    <div class="input-field">
        <label>your email</label><br>
        <input type="text" name="email">
    </div>
    <div class="input-field">
        <label>number</label><br>
        <input type="number" name="number">
    </div>
    <div class="input-field">
        <label>your message</label><br>
        <textarea name="message"></textarea>
    </div>
    <button type="submit" name="submit-btn">send message</button>
</form>
</div>  
<div class="line"></div>
<div class="line2"></div>
<div class="address">
    <h1 class="title">our contact</h1>
    <div class="row">
        <div class="box">
            <i class="fas fa-map"></i>
            <div>
                <h4>address</h4>
                <p>1093 rai residency,
                    kailash nagar,<br> vithalwadi,
                    kalyan, maharashtra,400933
                </p>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-phone"></i>
            <div>
                <h4>phone number</h4>
                <p>9653328739</p>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-envelope"></i>
            <div>
                <h4>email</h4>
                <p>aaloktiwari68@gmail.com</p>
            </div>
        </div>
    </div>
</div>
<div class="line3"></div>
<?php include 'footer.php';?>
<script type="text/javascript" src="script2.js"></script>
</body>
</html>