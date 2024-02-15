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
if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $number = mysqli_real_escape_string($conn,$_POST['number']);
    $method = mysqli_real_escape_string($conn,$_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no.'.$_POST['flate'].','.$_POST['street'].','.$_POST['city'].','.$_POST['state'].','.$_POST['country']
    .','.$_POST['pin']);
    $placed_on  = date('d-M-Y');
    $cart_total=0;
    $cart_product[]='';
    $cart_query=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    if (mysqli_num_rows($cart_query)>0) {
        while($cart_item=mysqli_fetch_assoc($cart_query)){
            $cart_product[]=$cart_item['name'].'('.$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total+=$sub_total;
        }
    }
    $total_products = implode(' , ' , $cart_product);
    $payment_status = ($method === 'cash on delivery') ? 'pending' : 'complete';
    mysqli_query($conn, "INSERT INTO `order`(`user_id`,`name`,`number`,`email`,`method`,`address`,`total_products`,`total_price`,`placed_on`,`payment_status`) VALUES('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on','$payment_status')");
    mysqli_query($conn,"DELETE FROM `cart` WHERE user_id='$user_id'");
    $message[]="order placed succesfully";
    header('location:checkout.php');
}
?>

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
            <h1>checkout</h1>
            <p>here you can do payments</p>
            <a href="index.php">home</a><span>/ order</span>
        </div>   
     </div>
     <div class="line"></div>
     <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
        if (isset($message)){
            foreach ($message as $message){
                echo '
                     <div class="message">
                     <span>'.$message.'</span>
                     <i class="fas fa-x-circle" onclick="this.parentElement.remove()"></i>
                     </div>

                    ';
            }
        }
        ?>
    <div class="display-order">
        <div class="box-container">
            <?php 
            $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
            $total=0;
            $grand_total=0;
            if(mysqli_num_rows($select_cart)>0) {
                while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                    $total_price=($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total=$total+=$total_price;
           ?>
            <div class="box">
                <img src="image/<?php echo $fetch_cart['image'];?>">
                <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
            </div>
           <?php
                }
            }
            ?>      
        </div>  
        <span class="grand-total">Total Amount Payable : ₹ <?= $grand_total; ?></span>
    </div>
    <form method="post" onsubmit="return validateCreditCard()">
        <div class="input-field">
            <label>your name</label>
            <input type="text" name="name" placeholder="enter your name">
        </div>
        <div class="input-field">
            <label>your number</label>
            <input type="text" name="number" id="number" placeholder="enter your number">
            <span id="number-error" class="error-message"></span>
        </div>
        <div class="input-field">
            <label>your email</label>
            <input type="text" name="email" placeholder="enter your email">
        </div>

        <div class="input-field">
            <label>select payment method</label>
            <select name="method" id="payment_method" onchange="toggleCreditCardFields()">
    <option selected disabled>select payment method</option>
    <option value="cash on delivery">Cash on delivery</option>
    <option value="credit card">Debit card</option>
    <option value="credit card">Credit card</option>
    <option value="paytm">paytm</option>
</select>

        </div>

        <!-- Credit Card Details -->
        <div id="credit_card_details" style="display: none;">
            <div class="input-field">
                <label>Cardholder Name</label>
                <input type="text" id="cardholder_name" name="cardholder_name" placeholder="Cardholder Name">
            </div>
            <div class="input-field">
                <label>Card Number</label>
                <input type="text" id="card_number" name="card_number" placeholder="Card Number">
            </div>
            <div class="input-field">
                <label>Expiry Date</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="Expiry Date (MM/YY)">
            </div>
            <div class="input-field">
                <label>CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="CVV">
            </div>
        </div>

        <div class="input-field">
            <label>address line 1</label>
            <input type="text" name="flate" placeholder="e.g flate">
        </div>
        <div class="input-field">
            <label>address line 2</label>
            <input type="text" name="street" placeholder="e.g street">
        </div>
        <div class="input-field">
            <label>city</label>
            <input type="text" name="city" placeholder="e.g thane">
        </div>
        <div class="input-field">
            <label>state</label>
            <input type="text" name="state" placeholder="e.g maharashtra">
        </div>
        <div class="input-field">
            <label>country</label>
            <input type="text" name="country" placeholder="e.g india">
        </div>
        <div class="input-field">
            <label>pincode</label>
            <input type="text" name="pin" placeholder="e.g 400605">
        </div>
        <input type="submit" name="order_btn" class="btn" value="order now">
        
    </form>
     </div>
<?php include 'footer.php';?>
<script>
    window.onload = function() {
    // Call toggleCreditCardFields() on page load to handle initial state
    toggleCreditCardFields();
}

function toggleCreditCardFields() {
    var method = document.getElementById('payment_method').value;
    var creditCardDetails = document.getElementById('credit_card_details');
    if (method === 'credit card') {
        creditCardDetails.style.display = 'block';
    } else {
        creditCardDetails.style.display = 'none';
    }
}

function validateCreditCard() {
    var method = document.getElementById('payment_method').value;
    if (method === 'credit card') {
        var cardholderName = document.getElementById('cardholder_name').value;
        var cardNumber = document.getElementById('card_number').value;
        var expiryDate = document.getElementById('expiry_date').value;
        var cvv = document.getElementById('cvv').value;

        // Validate cardholder name, card number, expiry date, and CVV here

        // For demonstration, you can use the basic validation provided in your existing code

        // Return false if any validation fails
    }
    return true;
}
function validateCreditCard() {
    var method = document.getElementById('payment_method').value;
    if (method === 'credit card') {
        var cardholderName = document.getElementById('cardholder_name').value;
        var cardNumber = document.getElementById('card_number').value;
        var expiryDate = document.getElementById('expiry_date').value;
        var cvv = document.getElementById('cvv').value;

        // Validate cardholder name
        if (cardholderName === '') {
            alert('Please enter the cardholder name.');
            return false;
        }

        // Validate card number (simple validation for demonstration)
        if (cardNumber === '' || isNaN(cardNumber) || cardNumber.length !== 16) {
            alert('Please enter a valid 16-digit card number.');
            return false;
        }

        // Validate expiry date (simple validation for demonstration)
        if (expiryDate === '' || expiryDate.length !== 5 || expiryDate.indexOf('/') !== 2) {
            alert('Please enter a valid expiry date in the format MM/YY.');
            return false;
        }

        // Validate CVV (simple validation for demonstration)
        if (cvv === '' || isNaN(cvv) || cvv.length !== 3) {
            alert('Please enter a valid 3-digit CVV.');
            return false;
        }
    }
    return true;
}
function validateForm() {
        var number = document.getElementById('number').value;
        var numberError = document.getElementById('number-error');
        var isValid = true;

        if (number === '' || isNaN(number) || number.length !== 10) {
            numberError.textContent = 'Please enter a valid 10-digit phone number.';
            isValid = false;
        } else {
            numberError.textContent = '';
        }

        return isValid;
    }
</script>
<script type="text/javascript" src="script2.js"></script>
</body>
</html>