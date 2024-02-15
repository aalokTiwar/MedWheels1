<?php
require('fpdf186/fpdf.php');
@include 'connection.php';

// Check if orderId is set in the query parameters
if(isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    // Fetch order details from the database
    $select_order = mysqli_query($conn, "SELECT * FROM `order` WHERE id='$orderId'");
    if(mysqli_num_rows($select_order) > 0) {
        $fetch_order = mysqli_fetch_assoc($select_order);

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font for title
        $pdf->SetFont('Arial', 'B', 16);

        // Add title
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

        // Set font for order details
        $pdf->SetFont('Arial', '', 12);

        // Add order details
        // Name with larger font
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Name: ' . $fetch_order['name'], 0, 1);
        // Other details
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Order ID: ' . $fetch_order['id'], 0, 1);
        $pdf->Cell(0, 10, 'Number: ' . $fetch_order['number'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $fetch_order['email'], 0, 1);
        $pdf->Cell(0, 10, 'Address: ' . $fetch_order['address'], 0, 1);
        $pdf->Cell(0, 10, 'Payment Method: ' . $fetch_order['method'], 0, 1);
        // Price with different font color
        $pdf->SetTextColor(255, 0, 0); // Red color for price
        $pdf->Cell(0, 10, 'Total Price: ' . $fetch_order['total_price'], 0, 1);
        $pdf->SetTextColor(0); // Reset text color
        $pdf->Cell(0, 10, 'Total Products: ' . $fetch_order['total_products'], 0, 1);
        // Payment status under the box
        $pdf->Cell(0, 10, 'Payment Status: ' . $fetch_order['payment_status'], 0, 1);

        // Add date on the right side but below other details
        $pdf->SetX(150); // Set X position for the date
        $pdf->Cell(0, 10, 'Date: ' . $fetch_order['placed_on'], 0, 1, 'R');

        // Add logo on the right side corner
        $pdf->Image('img/logo.png', 170, 10, 30);

        // Output the PDF
        $pdf->Output();
    } else {
        echo 'Order not found!';
    }
} else {
    echo 'Order ID not provided!';
}
?>
