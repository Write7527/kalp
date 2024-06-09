<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/user_login.php');
    exit;
}

include('../config/db.php');

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<h1>Browse Books</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php while ($book = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $book['title']; ?></td>
        <td><?php echo $book['author']; ?></td>
        <td><?php echo $book['price']; ?></td>
        <td><?php echo $book['description']; ?></td>
        <td><img src="<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>" width="50"></td>
        <td><a href="buy_book.php?id=<?php echo $book['id']; ?>">Buy</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php $conn->close(); ?>
