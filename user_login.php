<?php
include('../config/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: ../user/dashboard.php');
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "No user found with that username";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>User Login</h1>
    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <span class="error-message"></span>
        <input type="password" name="password" placeholder="Password" required>
        <span class="error-message"></span>
        <button type="submit">Login</button>
    </form>
    <script src="../js/scripts.js"></script>
</body>
</html>
