<?php
// Include the database connection
include('database.php');

// Fetch books from the database
$sql = "SELECT id, title, author, price, stock FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Available Books</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>KES {$row['price']}</td>
                <td>{$row['stock']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No books available.";
}

// Close the connection
$conn->close();
?>
