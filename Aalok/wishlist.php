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
    
     //adding product in cart
     if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $cart_num = mysqli_query($conn,"SELECT * FROM `cart` WHERE name= '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($cart_num)>0) {
            $message[]='product alredy exist in cart';
        }else{
            mysqli_query($conn,"INSERT INTO `cart`(`user_id`, `pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id',
            '$product_id','$product_name','$product_price','$product_quantity','$product_image')");
            $message[]='product succesfully added in your cart'; 
        }
    }
    //delete product from wishlist
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
    
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    
        header('location:wishlist.php');
    }
    if (isset($_GET['delete_all'])){
    
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    
        header('location:wishlist.php');
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
            <h1>my wishlist</h1>
            <p>here your wishlist products</p>
            <a href="index.php">home</a><span>/wishlist</span>
        </div>   
     </div>
   <!---->
   <section class="shop">
    <h1 class="title">products added in wishlist</h1>
    <?php
        if (isset($message)){
            foreach ($message as $message){
                echo '
                     <div class="message">
                     <span>'.$message.'</span>
                     <i class="fas fa-ban" onclick="this.parentElement.remove()"></i>
                     </div>

                    ';
            }
        }
    ?>
            <div class="box-container">
            <?php 
            $grand_total = 0;
            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist`") or die('query failed');
            if(mysqli_num_rows($select_wishlist)>0){
                while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
            ?>
            <form method="post" class="box">
                <img src="image/<?php echo $fetch_wishlist['image']; ?>">
                <div class="price">₹<?php echo $fetch_wishlist['price']; ?></div>
                <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-eye"></a>
                    <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'];?>" class="fas fa-ban" onclick="return
             confirm('do you want to delete  this product from  your wishlist')"></a>
                    <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
                </div>
            </form>
            <?php
                  $grand_total+=$fetch_wishlist['price'];
               }
            }else{
                echo '<p class="empty">no products added yet!</p>';

            }
            ?>
        </div>
        <div class="wishlist_total">
            <p>total amount payable : <span>₹</span><?php echo $grand_total; ?>/-</p>
            <a href="shop.php" class="btn">continue shoping</a>
            <a href="wishlist.php?delete_all" class="btn <?php echo ($grand_total)?'':'disabled'?>" onclick="return
             confirm('do you want to delete  all item in your wishlist')">delete all</a>
        </div>

    </section>
<?php include 'footer.php';?>
<script type="text/javascript" src="script2.js"></script>
</body>
</html>