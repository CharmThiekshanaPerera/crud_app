<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>PHP CRUD with Image Upload</h1>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
            <label for="image">Image:</label>
            <input type="file" name="image" required>
            <button type="submit" name="save">Save</button>
        </form>

        <h2>Items List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'crud_db');
            $result = $conn->query("SELECT * FROM items");
            while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><img src="uploads/<?php echo $row['image']; ?>"></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
