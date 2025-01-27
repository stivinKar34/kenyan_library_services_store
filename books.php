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

$customer_id = $_GET['customer_id'] ?? 0;

// Fetch books
$sql = "SELECT id, title, author, price, stock FROM books";
$result = $conn->query($sql);

echo "<h1>Available Books</h1>";

echo "<form method='POST' action='addToCart.php'>";
echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<table border='1'>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Quantity</th>
            <th>Add to Cart</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>KES {$row['price']}</td>
            <td>{$row['stock']}</td>
            <td><input type='number' name='quantity[{$row['id']}]' min='1' max='{$row['stock']}'></td>
            <td><input type='checkbox' name='book_ids[]' value='{$row['id']}'></td>
          </tr>";
}
echo "</table><br>";
echo "<button type='submit'>Add to Cart</button>";
echo "</form>";
 
?>

</body>
</html>
