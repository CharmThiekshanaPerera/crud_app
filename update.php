<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "uploads/".basename($image);

    if(!empty($image)) {
        $result = $conn->query("SELECT image FROM items WHERE id=$id");
        $row = $result->fetch_assoc();
        unlink("uploads/".$row['image']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE items SET name='$name', description='$description', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE items SET name='$name', description='$description' WHERE id=$id";
    }

    if($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
