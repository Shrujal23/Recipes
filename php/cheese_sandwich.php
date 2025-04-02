<?php 
session_start();
include_once('header.php'); 
?>

<div class="container recipe-detail">
    <h1>Cheese Sandwich Recipe</h1>
    
    <div class="video-container">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/6R1zq9bUx9I" 
                title="Cheese Sandwich Recipe Video" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
    </div>

    
    <div class="recipe-content">
        <h2>Ingredients:</h2>
        <ul>
            <li>4 slices bread</li>
            <li>2 slices cheddar cheese</li>
            <li>2 tbsp butter</li>
            <li>1 tomato, sliced</li>
        </ul>

        <h2>Steps:</h2>
        <ol>
            <li>Butter one side of each bread slice</li>
            <li>Place cheese and tomato between bread slices</li>
            <li>Heat skillet over medium heat</li>
            <li>Grill sandwich 2-3 minutes per side</li>
            <li>Serve warm</li>
        </ol>
    </div>

    <div class="comments-section">
        <h2>Comments:</h2>
        <form action="submit-comment.php" method="post">
            <textarea name="comment" rows="4" placeholder="Leave a comment..."></textarea><br>
            <input type="submit" value="Submit Comment">
        </form>
    </div>
</div>

<?php include_once('footer.php'); ?>
