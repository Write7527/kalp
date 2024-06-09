<?php
session_start();
include('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Welcome to the Online Bookstore</h1>
        <nav>
            <ul>
                <li><a href="auth/user_register.php">User Register</a></li>
                <li><a href="auth/user_login.php">User Login</a></li>
                <li><a href="auth/admin_register.php">Admin Register</a></li>
                <li><a href="auth/admin_login.php">Admin Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Browse Books</h2>
        <?php
        $sql = "SELECT * FROM books";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Title</th><th>Author</th><th>Price</th><th>Description</th><th>Image</th><th>Action</th></tr>';
            while ($book = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $book['title'] . '</td>';
                echo '<td>' . $book['author'] . '</td>';
                echo '<td>' . $book['price'] . '</td>';
                echo '<td>' . $book['description'] . '</td>';
                echo '<td><img src="' . $book['image'] . '" alt="' . $book['title'] . '" width="50"></td>';
                echo '<td><a href="user/buy_book.php?id=' . $book['id'] . '">Buy</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No books available at the moment.</p>';
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Online Bookstore</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
$conn->close();
?>
