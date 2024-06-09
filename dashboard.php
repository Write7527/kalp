<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/admin_login.php');
    exit;
}

include('../config/db.php');

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="add_book.php">Add Book</a></li>
                <li><a href="../auth/admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Books</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Title</th><th>Author</th><th>Price</th><th>Actions</th></tr>';
            while ($book = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $book['title'] . '</td>';
                echo '<td>' . $book['author'] . '</td>';
                echo '<td>' . $book['price'] . '</td>';
                echo '<td>';
                echo '<a href="edit_book.php?id=' . $book['id'] . '">Edit</a> | ';
                echo '<a href="delete_book.php?id=' . $book['id'] . '">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No books available.</p>';
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Online Bookstore</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
