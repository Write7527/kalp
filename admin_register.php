<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Check if username or email already exists
    $check_sql = "SELECT * FROM admins WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $error_message = "Username or Email already exists.";
    } else {
        $sql = "INSERT INTO admins (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Admin registered successfully. Please <a href='admin_login.php'>login here</a>.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Registration</h1>
    </header>
    <main>
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        }
        ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <span class="error-message"></span>
            <input type="password" name="password" placeholder="Password" required>
            <span class="error-message"></span>
            <input type="email" name="email" placeholder="Email" required>
            <span class="error-message"></span>
            <button type="submit">Register</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Online Bookstore</p>
    </footer>
    <script src="../js/scripts.js"></script>
</body>
</html>
