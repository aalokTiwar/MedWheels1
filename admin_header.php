<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
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
                <a href="admin_panel.php">home</a>
                <a href="admin_product.php">products</a>
                <a href="admin_order.php">orders</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">messages</a>
            </nav> 
            <div class="icons">
                <i class="fas fa-user" id="user-btn-profile"></i>

            </div>        
            <div class="user-box-details">
                <p>adminname : <span><?php echo $_SESSION['admin_name'];?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email'];?></span></p>
                <form method="post" style="display: block;">
                    <button type="submit" class="logout-btn" name="logout">log out</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>"Your one-stop solution for convenient and secure medicine delivery, 
                bringing prescribed medications to your doorstep with a user-friendly website."
</p>
        </div>   
     </div>
    </body>
</html>