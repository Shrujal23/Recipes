<?php 
    session_start();
    include_once('header.php');
    require_once 'connect.php';
?>

<style>
<?php
include '../css/recipe-individual.css';
?>
</style>




  <!-- Heading -->

  <div class="container title">
    <?php
      $id = $_GET['id'];
      $r = mysqli_query($conn, "SELECT * FROM posts WHERE id = '" . $id. "'");
      $rowData = mysqli_fetch_array($r);
    ?>
    <div class="heading"><?php echo $rowData['title']; ?> <span class="veg-logo"> <img src="../images/veg-logo.png"></span></div>
    <div class="author-date">Uploaded By : <?php echo $rowData['username']; ?> | <?php echo $rowData['date']; ?></div>
    <div class="rating">4.5 Ratings
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star-half"></i>
    </div>
  </div>

  <!-- Heading End -->

  <!-- Image Section Start -->

  <div class="container">
    <div class="row">
      <div class="col-6 recipe-img">
        <img src="../images/<?php echo $rowData["imagefile"] ?> " alt="Chhole Bhature">
      </div>

      <div class="col-2 prep-info">

        <div><i class="fa fa-history prep-icon"></i> Total Time <b><?php echo $rowData['totaltime']?></b></div>
        <div><i class="fa fa-history prep-icon"></i> Prep Time <b><?php echo $rowData['preptime']?></b></div>
        <div><i class="fa fa-fire prep-icon"></i> Calories <b><?php echo $rowData['calories']?></b></div>
        <div class="share-btn">Click here to Share &nbsp; <i class="fa fa-btn fa-share-square"></i></div>
        <div class="bookmark-btn ">Bookmark Recipe &nbsp; <i class="fa fa-btn fa-bookmark"></i> </div>
      </div>
    </div>
  </div>


  <!-- Image Section End -->

  <!-- Recipe Section Starts -->
  <div class="container">
    <div class="about">
      <?php echo $rowData['about']; ?>
    </div>


    <div class="ingredients">
      <div class="ingredient-title">
        Ingredients of <?php echo $rowData['title']; ?>
      </div>

      <!-- List -->
      <?php $ingredients = explode(",", $rowData['ingredients']);?>
      <div class="ingredient-list">
        <div class="row">
          <div class="col">
            <ul class="list-group">
              <?php
                for($i = 0; $i < count($ingredients)/2; $i++) { ?>
                  <li class="list-group-item"><?php echo $ingredients[$i]; ?></li>
                <?php }
              ?>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group">
              <?php
                for($i = count($ingredients)/2 + 1; $i < count($ingredients); $i++) { ?>
                  <li class="list-group-item"><?php echo $ingredients[$i]; ?></li>
                <?php }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Recipe Section Ends -->

  <!-- Steps start -->
  <div class=" container step-container">
    <div class="step-heading">How to make <?php echo $rowData['title']; ?>?</div>

    <!-- step 1 -->
    <div class="step">
      <div class="step-title">Step 1</div>
      <div class="step-info">
        <?php echo $rowData['step1']; ?>
      </div>
    </div>

    <!-- step 2 -->
    <div class="step">
      <div class="step-title">Step 2</div>
      <div class="step-info">
        <?php echo $rowData['step2']; ?>
      </div>
    </div>

      <!-- step 3 -->
      <div class="step">
      <div class="step-title">Step 3</div>
      <div class="step-info">
        <?php echo $rowData['step3']; ?>
      </div>
    </div>
          <!-- Steps end -->


          <!-- Tips start -->
          <?php $tips = explode(".", $rowData['tips']);?>
          <div class="tips container">
            Tips
          </div>
          <div class="tips-block">
            <ul>
            <?php
                for($i = 0; $i < count($tips); $i++) { ?>
                  <li><?php echo $tips[$i]; ?></li>
                <?php }
              ?>
            </ul>
          </div>
          <!-- Tips End -->

        </div>
      </div>
    </div>
  </div>

  <!-- Comment Section Start -->
  <div class="container mt-5">
    <h3 class="mb-4">Leave a Comment</h3>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
        $user_id = isset($_SESSION['u_id']) ? $_SESSION['u_id'] : null;
        $recipe_id = $id; // Recipe ID from the URL
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        if ($user_id) {
            $query = "INSERT INTO comments (user_id, recipe_id, comment, date) VALUES ('$user_id', '$recipe_id', '$comment', NOW())";
            if (mysqli_query($conn, $query)) {
                echo "<p class='text-success'>Comment added successfully!</p>";
            } else {
                echo "<p class='text-danger'>Failed to add comment. Please try again.</p>";
            }
        } else {
            echo "<p class='text-danger'>You must be logged in to leave a comment.</p>";
        }
    }
    ?>

    <form action="" method="POST">
        <div class="mb-3">
            <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>

    <hr class="my-5">

    <h4>Comments</h4>
    <div class="comments-section">
        <?php
        $comments_query = "SELECT c.comment, c.date, u.name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.recipe_id = '$id' ORDER BY c.date DESC";
        $comments_result = mysqli_query($conn, $comments_query);

        if (mysqli_num_rows($comments_result) > 0) {
            while ($comment_row = mysqli_fetch_assoc($comments_result)) {
                echo "<div class='comment mb-4'>";
                echo "<h5 class='mb-1'>" . htmlspecialchars($comment_row['name']) . "</h5>";
                echo "<p class='mb-1'>" . htmlspecialchars($comment_row['comment']) . "</p>";
                echo "<small class='text-muted'>" . date('F j, Y, g:i a', strtotime($comment_row['date'])) . "</small>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        ?>
    </div>
  </div>
  <!-- Comment Section End -->

  <?php include_once('footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const shareBtn = document.querySelector('.share-btn');
    const bookmarkBtn = document.querySelector('.bookmark-btn');
    // Use the heading text as recipe title and current URL as the recipe URL.
    const recipeTitle = document.querySelector('.heading').innerText;
    const recipeUrl = window.location.href;
    const recipeId = "<?php echo $rowData['id']; ?>";
    
    // Share Button Functionality
    shareBtn.addEventListener('click', function(){
        if (navigator.share) {
            navigator.share({
                title: recipeTitle,
                text: 'Check out this recipe!',
                url: recipeUrl
            }).then(() => {
                console.log('Recipe shared successfully.');
            }).catch((error) => {
                console.error('Error sharing recipe:', error);
            });
        } else if (navigator.clipboard) {
            // Fallback: copy URL to clipboard and notify user
            navigator.clipboard.writeText(recipeUrl).then(() => {
                alert('Recipe URL copied to clipboard.');
            }).catch((error) => {
                alert('Unable to copy URL, please try manually.');
            });
        } else {
            alert('Sharing is not supported in this browser.');
        }
    });
    
    // Bookmark Button Functionality
    bookmarkBtn.addEventListener('click', function(){
        // Retrieve bookmark list from localStorage
        let bookmarks = JSON.parse(localStorage.getItem('bookmarkedRecipes') || '[]');
        if (bookmarks.includes(recipeId)) {
            // Remove recipe from bookmarks
            bookmarks = bookmarks.filter(id => id !== recipeId);
            bookmarkBtn.innerHTML = 'Bookmark Recipe &nbsp; <i class="fa fa-btn fa-bookmark"></i>';
            alert('Recipe removed from bookmarks.');
        } else {
            // Add recipe to bookmarks
            bookmarks.push(recipeId);
            bookmarkBtn.innerHTML = 'Bookmarked &nbsp; <i class="fa fa-btn fa-bookmark"></i>';
            alert('Recipe bookmarked.');
        }
        localStorage.setItem('bookmarkedRecipes', JSON.stringify(bookmarks));
    });
});
</script>

