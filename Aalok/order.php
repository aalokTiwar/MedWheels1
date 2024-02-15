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
            <h1>Order</h1>
            <p>Here you can see your orders.</p>
            <a href="index.php">Home</a><span>/ Order</span>
        </div>   
    </div>
    <div class="line"></div>
    <div class="order-section">
        <div class="box-container">
            <?php
            $select_orders=mysqli_query($conn, "SELECT * FROM `order` WHERE user_id='$user_id'") or die('query failed');
            if (mysqli_num_rows($select_orders)>0) {
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="box">
                <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
                <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
                <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
                <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
                <p>Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
                <p>Your Order: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                <p>Total Price: <span><?php echo $fetch_orders['total_price']; ?></span></p>
                <p>Payment Status: <span><?php echo $fetch_orders['payment_status']; ?></span></p>
                <!-- Print Invoice Button -->
                <button class="print-invoice-btn" onclick="printInvoice(<?php echo $fetch_orders['id']; ?>)">Print Invoice</button>
            </div>
           <?php     
                }
             } else {
                echo '
                <div class="empty">
                    <p>No order added yet!</p>
                </div>
                ';
             }
            ?>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script2.js"></script>
    <script>
        function printInvoice(orderId) {
            // Open the invoice.php file with the orderId as a query parameter in a new window for printing
            window.open('invoice.php?orderId=' + orderId, '_blank');
        }
    </script>
</body>
</html>
