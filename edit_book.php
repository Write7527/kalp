<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/admin_login.php');
    exit;
}

include('../config/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id='$id'";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE books SET title='$title', author='$author', price='$price', description='$description', image='$image' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
    <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
    <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
    <input type="text" name="price" value="<?php echo $book['price']; ?>" required>
    <textarea name="description"><?php echo $book['description']; ?></textarea>
    <input type="text" name="image" value="<?php echo $book['image']; ?>">
    <button type="submit">Update Book</button>
</form>
