<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="processForm.css">
</head>
<body>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('databaseConnect.php'); // Include your database connection

    // Collect data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert into the `customers` table
    $stmt = $conn->prepare("INSERT INTO customers (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<h1 class = 'thank-you'>Thank you, $name! Your message has been received.</h1>\n";
        echo "<br/>";
        echo "<br/>";
        echo "<a href='books.php?customer_id={$stmt->insert_id}' class='view-books-link'>View Available Books</a>";
    } else {
        echo "<h1>Error submitting your details. Please try again.</h1>";
        echo "Error: " . $stmt->error;
    }
}
?>


</body>
</html>
