<?php
session_start();
include_once('header.php');
require_once 'connect.php'; // Ensure the database connection is included
?>

<style>
    /* ----------------------------------------
       Floating Action Button (FAB) Styling
    ---------------------------------------- */
    .fab {
        position: fixed;
        bottom: 80px; /* Adjusted to be above the footer */
        right: 20px; /* Positioned to the right */
        z-index: 999;
        background-color: tomato;
        color: white;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, transform 0.3s;
        animation: bounce 2s infinite;
    }
    .fab:hover {
        background-color: #d84315;
        transform: scale(1.1);
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }

    /* ----------------------------------------
       Login Prompt Modal Styling
    ---------------------------------------- */
    .modal-header {
        background-color: #dc3545;
        color: #fff;
        border-bottom: none;
    }
    .modal-title {
        font-weight: bold;
    }
    .modal-footer .btn {
        min-width: 100px;
    }

    /* ----------------------------------------
       Main Content (Blog) Styling
    ---------------------------------------- */
    .content-wrapper {
        margin-top: 2rem;
        padding: 2rem;
        background-color: #fff;
        border-radius: 0.5rem;
    }
    .content-wrapper h1 {
        color: tomato;
        font-weight: bold;
    }

    /* ----------------------------------------
       Blog Card Styling
    ---------------------------------------- */
    .card {
        border: none;
        border-radius: 0.5rem;
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .card-title a {
        text-decoration: none;
        transition: color 0.3s;
    }
    .card-title a:hover {
        color: tomato;
    }
    .btn-outline-danger {
        transition: background-color 0.3s, color 0.3s;
    }
    .btn-outline-danger:hover {
        background-color: tomato;
        color: #fff;
    }

    /* Blog Card Image Styling */
    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    /* Blog Card Text Styling */
    .card-text {
        font-size: 0.95rem;
        color: #555;
    }
</style>

<!-- Login Prompt Modal -->
<div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptModalLabel">Login Required</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Please login to write a blog post.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-danger" onclick="window.location.href='login.php'">Login</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<button class="fab" onclick="handleWriteBlog()">
    <i class="fa fa-pencil" style="font-size: 24px;"></i>
</button>

<main class="container content-wrapper shadow-lg mt-lg-4">
    <div class="row">
        <h1 class="text-center mt-md-3 mb-5">Blog</h1>
        
        <section class="col-md-8 mx-auto">
            <?php
            // Fetch blogs from the database
            $query = "SELECT * FROM posts ORDER BY date DESC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $post_title = $row['title'];
                $post_date = $row['date'];
                $post_link = "blog-post" . $row['id'] . ".php"; // Assuming each post has a unique ID
                $post_excerpt = substr($row['about'], 0, 100) . '...'; // Excerpt from the 'about' field
            ?>
                <div class="card mb-4 shadow-sm">
                    <?php if (!empty($post_image)) { ?>
                        <img src="../images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
                    <?php } ?>
                    <div class="card-body">
                        <h2 class="card-title"><a href="<?php echo $post_link; ?>" class="text-dark"><?php echo $post_title; ?></a></h2>
                        <p class="text-muted">Posted on <?php echo date('F j, Y', strtotime($post_date)); ?></p>
                        <p class="card-text"><?php echo $post_excerpt; ?></p>
                        <a href="<?php echo $post_link; ?>" class="btn btn-outline-danger">Read More</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </div>
</main>

<script>
    function handleWriteBlog() {
        <?php if(isset($_SESSION['u_id'])) { ?>
            window.location.href = 'write-blog.php';
        <?php } else { ?>
            // Show Bootstrap modal
            var loginPromptModal = new bootstrap.Modal(document.getElementById('loginPromptModal'));
            loginPromptModal.show();
        <?php } ?>
    }
</script>

<?php
include_once('footer.php');
?>
