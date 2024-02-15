<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdeliver.net/npm/bootstrap-icons@1.9.1/front/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin_panel.php" class="logo"><img src="img/logo.png"></a>
             <h2 class="logo">MedWheels</h2>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about.php">About us</a>
                <a href="shop.php">Shop</a>
                <a href="order.php">Order</a>
                <a href="contact.php">Contact</a>
            </nav> 
            <div class="icons">
                <i class="fas fa-user" id="user-btn-profile"></i>
                <?php
                    $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
                    $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="fas fa-heart"></i><sup><?php echo $wishlist_num_rows; ?></sup></a>
                <?php
                    $select_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                    $cart_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i><sup><?php echo $cart_num_rows; ?></sup></a>

              
            </div>           
            <div class="user-box-details">
                <p>username : <span><?php echo $_SESSION['user_name'];?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email'];?></span></p>
                <form method="post" style="display: block;">
                    <button type="submit" class="logout-btn" name="logout">log out</button>
                </form>
            </div>
           
        </div>
    </header>
   
    </body>
</html>