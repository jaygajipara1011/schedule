<?php
include 'db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
           
                <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
            </td>
             <br>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}
?>
