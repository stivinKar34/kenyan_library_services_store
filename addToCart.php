<?php
include('databaseConnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $book_ids = $_POST['book_ids'] ?? [];
    $quantities = $_POST['quantity'] ?? [];

    foreach ($book_ids as $book_id) {
        $quantity = $quantities[$book_id] ?? 1;

        $stmt = $conn->prepare("INSERT INTO cart (customer_id, book_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $customer_id, $book_id, $quantity);
        $stmt->execute();
    }

    header("Location: viewCart.php?customer_id=$customer_id");
    exit;
}
?>
