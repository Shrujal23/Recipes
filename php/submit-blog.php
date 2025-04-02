<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    // Handle image upload
    $imagePath = null; // Default to null
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imagePath = 'uploads/' . basename($image['name']);
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Allow submission without an image
            $imagePath = null; // Set to null if image upload fails
        }
    }

    // Basic validation
    if (empty($title) || empty($content)) {
        die("Please fill in all required fields");
    }

    // Insert blog post into database
    $query = "INSERT INTO posts (title, about, imagefile, date) 
              VALUES ('$title', '$content', '$imagePath', NOW())"; 

    if (mysqli_query($conn, $query)) {
        header("Location: blog.php?message=Blog successfully added.");
        exit();
    } else {
        die("Error submitting blog: " . mysqli_error($conn));
    }

} else {
    header("Location: write-blog.php");
    exit();
}
?>
