<?php 
session_start();
include_once('header.php'); 
?>

<div class="container recipe-detail">
    <h1>Mango Smoothie Recipe</h1>
    
    <div class="video-container">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/6x8ZSoGXm24" 
                title="Mango Smoothie Recipe Video" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
    </div>

    
    <div class="recipe-content">
        <h2>Ingredients:</h2>
        <ul>
            <li>2 ripe mangoes</li>
            <li>1 cup plain yogurt</li>
            <li>1/2 cup milk</li>
            <li>1 tbsp honey</li>
            <li>1/2 cup ice cubes</li>
        </ul>

        <h2>Steps:</h2>
        <ol>
            <li>Peel and chop mangoes</li>
            <li>Add mango pieces to blender</li>
            <li>Add yogurt, milk, and honey</li>
            <li>Blend until smooth</li>
            <li>Add ice cubes and blend again</li>
            <li>Serve chilled</li>
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
