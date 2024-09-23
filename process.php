<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Simple response (you can process data and return it)
    echo "Hello, $name. Your email is $email.";
}
?>
