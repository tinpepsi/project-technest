<?php
session_start(); // Start the session to access session variables

// Include database connection
include 'db_connect.php'; 

// Check if receipt_id is passed in the URL
if (isset($_GET['receipt_id']) && !empty($_GET['receipt_id'])) {
    $receipt_id = intval($_GET['receipt_id']); // Get the receipt_id from URL
} else {
    echo "Invalid receipt ID.";
    exit();
}

try {
    // Prepare SQL to get receipt details along with the cart products
    $query = "
        SELECT r.receipt_id, r.total_amount, r.receipt_date, 
               c.cart_id, c.quantity, p.name AS product_name, p.price
        FROM receipt r
        JOIN receipt_cart rc ON r.receipt_id = rc.receipt_id
        JOIN cart c ON rc.cart_id = c.cart_id
        JOIN product p ON c.product_id = p.product_id
        WHERE r.receipt_id = ?
    ";

    // Prepare statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $receipt_id);  // Bind the receipt_id to the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the receipt details
        $receiptDetails = $result->fetch_all(MYSQLI_ASSOC);
        $totalAmount = $receiptDetails[0]['total_amount'];  // Assuming the total amount is the same for all rows
        $receiptDate = $receiptDetails[0]['receipt_date'];  // Assuming the date is the same for all rows
    } else {
        echo "<p>No products found for this receipt.</p>";
        exit(); // Exit if no data is found
    }

    // Fetch user details from the users table
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Assuming the user_id is stored in session
        $userQuery = "SELECT name, phone_number, address, country FROM users WHERE user_id = ?";
        $userStmt = $conn->prepare($userQuery);
        $userStmt->bind_param("i", $user_id);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        
        if ($userResult->num_rows > 0) {
            $userDetails = $userResult->fetch_assoc();
            $userName = $userDetails['name'];
            $userPhone = $userDetails['phone_number'];
            $userAddress = $userDetails['address'];
            $userCountry = $userDetails['country'];
        } else {
            echo "User details not found.";
            exit(); // Exit if user details are not found
        }

        // Close the user statement
        $userStmt->close();
    } else {
        echo "User not logged in.";
        exit(); // Exit if the user is not logged in
    }

} catch (Exception $e) {
    echo "Error retrieving receipt details: " . $e->getMessage();
}

// Close the receipt statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="include/css/style.css">
</head>
<body>

<div class="container receipt_cont">
    <div class="receipt-wrapper">
        <div class="receipt-header">
            <h1>TechNest</h1>
            <p>Address: <?php echo htmlspecialchars($userAddress); ?></p>
            <p>Country: <?php echo htmlspecialchars($userCountry); ?></p>
            <p>Phone: <?php echo htmlspecialchars($userPhone); ?></p>
        </div>

        <div class="receipt-info">
            <p><strong>Receipt ID:</strong> <span id="receipt-id"><?php echo htmlspecialchars($receipt_id); ?></span></p>
            <p><strong>Date:</strong> <span id="receipt-date"><?php echo date('Y-m-d', strtotime($receiptDate)); ?></span></p>
        </div>

        <div class="receipt-items">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price (unit)</th>
                    <th>Total (RM)</th>
                </tr>
                <?php
                // Display items
                foreach ($receiptDetails as $row) {
                    $itemName = htmlspecialchars($row['product_name']);
                    $quantity = (int)$row['quantity'];
                    $price = (float)$row['price'];
                    $totalPrice = $quantity * $price;

                    echo "<tr>
                            <td>$itemName</td>
                            <td>$quantity</td>
                            <td>RM" . number_format($price, 2) . "</td>
                            <td>RM" . number_format($totalPrice, 2) . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="receipt-total">
            <p><strong>Total: RM<?php echo number_format($totalAmount, 2); ?></strong></p>
        </div>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
        </div>
    </div>
</div>

<a href="shop.php" class="shop-button">Continue Shopping</a>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
