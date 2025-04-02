<?php
require_once 'connect.php';

$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY date DESC");
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . " - Title: " . $row['title'] . " - Content: " . $row['about'] . "<br>";
    }
} else {
    echo "No posts found.";
}
?>
