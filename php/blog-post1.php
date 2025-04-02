<?php
session_start();
include_once('header.php');
?>

<main class="container content-wrapper shadow-lg mt-lg-4">
    <div class="row">
        <h1 class="text-center mt-md-3" style="color: tomato; font-weight: bolder">5 Tips for Perfect Baking Every Time</h1>
        
        <section class="col-md-8 mx-auto">
            <p class="text-muted">Posted on January 1, 2025</p>
            
            <h3>1. Measure Ingredients Precisely</h3>
            <p>Baking is a science, and accurate measurements are crucial. Use proper measuring cups and spoons, and level off dry ingredients for consistency.</p>
            
            <h3>2. Understand Your Oven</h3>
            <p>Every oven is different. Invest in an oven thermometer to ensure accurate temperatures and rotate your pans for even baking.</p>
            
            <h3>3. Room Temperature Ingredients</h3>
            <p>Allow ingredients like eggs and butter to come to room temperature before baking. This helps create a smoother batter and better texture.</p>
            
            <h3>4. Don't Overmix</h3>
            <p>Mix your batter just until the ingredients are combined. Overmixing can lead to tough baked goods.</p>
            
            <h3>5. Practice Patience</h3>
            <p>Allow baked goods to cool properly before slicing or decorating. This helps set the structure and improves the final texture.</p>
            
            <a href="blog.php" class="btn btn-primary mt-3">← Back to Blog</a>

            <div class="comments-section mt-5">
                <h3>Comments</h3>
                
                <?php
                // Display existing comments
                include_once('connect.php');
                $query = "SELECT * FROM blog_comments WHERE blog_id = 1 ORDER BY created_at DESC";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="comment mb-3">';
                        echo '<div class="comment-header">';
                        echo '<strong>' . htmlspecialchars($row['name']) . '</strong>';
                        echo '<small class="text-muted ml-2">' . date('M j, Y g:i a', strtotime($row['created_at'])) . '</small>';
                        echo '</div>';
                        echo '<div class="comment-body">' . htmlspecialchars($row['comment']) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No comments yet. Be the first to comment!</p>';
                }
                ?>

                <div class="comment-form mt-4">
                    <h4>Leave a Comment</h4>
                    <form method="post" action="submit-comment.php">
                        <input type="hidden" name="blog_id" value="1">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Your Comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
include_once('footer.php');
?>
