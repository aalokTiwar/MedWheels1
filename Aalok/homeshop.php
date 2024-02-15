<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdeliver.net/npm/bootstrap-icons@1.9.1/front/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <title>MedWheels</title>
</head>
<body>
    <section class="popular-brands">
        <h2>FEATURES MEDICINES</h2>
        <?php
        if (isset($message)){
            foreach ($message as $message){
                echo '
                     <div class="message">
                     <span>'.$message.'</span>
                     <i class="fas fa-xmark" onclick="this.parentElement.remove()"></i>
                     </div>

                    ';
            }
        }
    ?>
        <div class="popular-brands-content">
            <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="card">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <div class="price">₹<?php echo $fetch_products['price']; ?></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_quantity" value="1" min="0">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                    <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
                    <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
                </div>
            </form>
            <?php
               }
            }else{
                echo '<p class="empty">no products added yet!</p>';

            }
            ?>
        </div>

    </section>
</body>
</html>