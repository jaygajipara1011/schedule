<?php
include 'db.php';

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "User added successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
