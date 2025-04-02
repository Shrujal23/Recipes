<?php
require_once 'connect.php';

$result = mysqli_query($conn, "SELECT * FROM users");
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . " - Username: " . $row['username'] . " - Email: " . $row['email'] . "<br>";
    }
} else {
    echo "No users found.";
}
?>
