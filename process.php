<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');

if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "uploads/".basename($image);

    $sql = "INSERT INTO items (name, description, image) VALUES ('$name', '$description', '$image')";
    if($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = $conn->query("SELECT image FROM items WHERE id=$id");
    $row = $result->fetch_assoc();
    unlink("uploads/".$row['image']);
    $conn->query("DELETE FROM items WHERE id=$id");
    header("Location: index.php");
}
?>
