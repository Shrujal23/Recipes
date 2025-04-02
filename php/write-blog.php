<?php
session_start();
include_once('header.php');

if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
    exit();
}
?>

<style>
    /* Enhance blog form styling */
    main.content-wrapper {
        background-color: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h1 {
        color: tomato;
        font-weight: bolder;
    }
    .form-label {
        font-weight: 500;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.75rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus {
        border-color: tomato;
        box-shadow: 0 0 0 0.2rem rgba(255, 99, 71, 0.25);
    }
    button.btn-primary {
        background-color: tomato;
        border: none;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }
    button.btn-primary:hover {
        background-color: #e85a4f;
        transform: scale(1.02);
    }
</style>

<main class="container content-wrapper shadow-lg mt-lg-4">
    <div class="row">
        <h1 class="text-center mt-md-3">Write a Blog</h1>
        
        <section class="col-md-8 mx-auto">
            <form action="submit-blog.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Featured Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit Blog</button>
            </form>
        </section>
    </div>
</main>

<?php
include_once('footer.php');
?>
