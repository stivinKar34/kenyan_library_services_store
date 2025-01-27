<?php
$cssPath = 'styles.css';

include('databaseConnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];

    // Calculate the total amount
    $sql = "SELECT SUM(books.price * cart.quantity) AS total_amount
            FROM cart
            JOIN books ON cart.book_id = books.id
            WHERE cart.customer_id = $customer_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_amount = $row['total_amount'];

    // Insert into orders
    $stmt = $conn->prepare("INSERT INTO orders (customer_id, total_amount) VALUES (?, ?)");
    $stmt->bind_param("id", $customer_id, $total_amount);
    $stmt->execute();

    // Clear the cart
    $conn->query("DELETE FROM cart WHERE customer_id = $customer_id");
    
    echo '<p style="color: green; font-weight: bold;">Order submitted successfully!</p>';
}
?>






