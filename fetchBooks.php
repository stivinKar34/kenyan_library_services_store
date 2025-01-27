<?php
// Include the database connection file
include('databaseConnect.php');

// Define the SQL query to fetch book details
$sql = "SELECT id, title, author, price, stock FROM books";

// Execute the query and store the result
$result = $conn->query($sql);

// Initialize an array to hold the book data
$books = array();

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Fetch each row as an associative array
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
} else {
    // If no books are found, set an appropriate message
    $books = array('message' => 'No books available.');
}

// Close the database connection
$conn->close();

// Set the Content-Type header to application/json
header('Content-Type: application/json');

// Encode the books array to JSON and output it
echo json_encode($books);
?>

