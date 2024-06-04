<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM items WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Item</h1>
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            <label for="description">Description:</label>
            <textarea name="description" required><?php echo $row['description']; ?></textarea>
            <label for="image">Image:</label>
            <input type="file" name="image">
            <img src="uploads/<?php echo $row['image']; ?>">
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
