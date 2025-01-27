<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="viewCart.css">
</head>
<body>






<?php
include('databaseConnect.php');

$customer_id = $_GET['customer_id'];

// Fetch cart items
$sql = "SELECT cart.id, books.title, books.price, cart.quantity,
               (books.price * cart.quantity) AS total
        FROM cart
        JOIN books ON cart.book_id = books.id
        WHERE cart.customer_id = $customer_id";
$result = $conn->query($sql);

$total_amount = 0;

echo "<h1>Your Cart</h1>";
echo "<form method='POST' action='submitOrder.php'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<table border='1'>
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['title']}</td>
            <td>KES {$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>KES {$row['total']}</td>
          </tr>";
    $total_amount += $row['total'];
}
echo "</table><br>";
echo "<strong>Grand Total: KES $total_amount</strong><br><br>";
echo "<button type='submit'>Submit Order</button>";
echo "</form>";
?>




</body>
</html>