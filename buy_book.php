<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/user_login.php');
    exit;
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Insert purchase details into the purchases table
    $sql = "INSERT INTO purchases (user_id, book_id) VALUES ('$user_id', '$book_id')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Book purchased successfully.";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $error_message = "No book selected.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Book</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Buy Book</h1>
    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    if (isset($success_message)) {
        echo "<p class='success'>$success_message</p>";
    }
    ?>
    <a href="../index.php">Back to Home</a>
</body>
</html>
