<?php
session_start();
include_once('header.php');
require_once 'connect.php';

// Fetch the blog post based on the ID passed in the URL
if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']);
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $post_title = $row['title'];
        $post_date = $row['date'];
        $post_content = $row['content']; // Assuming 'content' contains the full blog post
        $post_image = $row['image']; // Assuming there's an 'image' field
    } else {
        echo "<p class='text-center text-danger'>Blog post not found.</p>";
        exit();
    }
} else {
    echo "<p class='text-center text-danger'>Invalid blog post ID.</p>";
    exit();
}
?>

<style>
    /* Blog Post Page Styling */
    .blog-post-wrapper {
        margin-top: 2rem;
        padding: 2rem;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .blog-post-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: tomato;
        margin-bottom: 1rem;
    }

    .blog-post-date {
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 1.5rem;
    }

    .blog-post-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .blog-post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .back-to-blog {
        display: inline-block;
        margin-top: 2rem;
        font-size: 1rem;
        color: tomato;
        text-decoration: none;
        transition: color 0.3s;
    }

    .back-to-blog:hover {
        color: #d84315;
    }
</style>

<main class="container blog-post-wrapper">
    <h1 class="blog-post-title"><?php echo htmlspecialchars($post_title); ?></h1>
    <p class="blog-post-date">Posted on <?php echo date('F j, Y', strtotime($post_date)); ?></p>
    <?php if (!empty($post_image)) { ?>
        <img src="../images/<?php echo $post_image; ?>" alt="<?php echo htmlspecialchars($post_title); ?>" class="blog-post-image">
    <?php } ?>
    <div class="blog-post-content">
        <?php echo nl2br(htmlspecialchars($post_content)); ?>
    </div>
    <a href="blog.php" class="back-to-blog">&larr; Back to Blog</a>
</main>

<?php include_once('footer.php'); ?>