<?php
// Start the session to manage user sessions
session_start();

// Include the database connection
include('db_connect.php');

// Query to retrieve data from the receipt table
$sql = "SELECT receipt_id, total_amount, receipt_date FROM receipt";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - E-Commerce</title>
    <link rel="stylesheet" href="include/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="order-history-page">
    <div class="container">
        <div class="header">
            <h1>Order History</h1>
            <input class="search-bar" type="text" placeholder="Search Order ID..." onkeyup="searchReceipt()">
        </div>
        <table id="orderHistoryTable">
            <thead>
                <tr>
                    <th>Receipt ID</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are records in the receipt table
                if ($result->num_rows > 0) {
                    // Loop through the result and display each record
                    while($row = $result->fetch_assoc()) {
                        // Format the receipt_date to only display the date
                        $formatted_date = date("Y-m-d", strtotime($row["receipt_date"]));

                        echo "<tr>";
                        echo "<td>" . $row["receipt_id"] . "</td>";
                        echo "<td>RM" . number_format($row["total_amount"], 2) . "</td>";
                        echo "<td>" . $formatted_date . "</td>"; // Display the formatted date
                        echo "<td><a href='receipt.php?receipt_id=" . $row['receipt_id'] . "'><i class='fas fa-file-invoice receipt-icon' title='View Receipt'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <button class="profile-btn" onclick="location.href='profile.php'">PROFILE</button>
</div>

<script>
// JavaScript function to search and filter the receipt_id
function searchReceipt() {
    let input = document.querySelector('.search-bar').value.toUpperCase(); // Get the value typed in the search bar
    let table = document.getElementById("orderHistoryTable");
    let rows = table.getElementsByTagName("tr");

    // Loop through all rows, except the first one (header)
    for (let i = 1; i < rows.length; i++) {
        let cell = rows[i].getElementsByTagName("td")[0]; // Get the first column (receipt_id)
        
        if (cell) {
            let receiptId = cell.textContent || cell.innerText;
            
            // If the receipt_id matches the search input, show the row, else hide it
            if (receiptId.toUpperCase().indexOf(input) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}


</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
