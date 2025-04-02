<?php 
session_start();
include_once('header.php'); 
?>

<div class="container recipe-detail">
    <h1>Pizza Recipe</h1>
    
    <div class="video-container">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/sv3TXMSv6Lw" 
                title="Pizza Recipe Video" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
    </div>

    
    <div class="recipe-content">
        <h2>Ingredients:</h2>
        <ul>
            <li>Pizza dough</li>
            <li>1/2 cup tomato sauce</li>
            <li>1 cup shredded mozzarella cheese</li>
            <li>10-12 slices pepperoni</li>
            <li>1/2 cup sliced mushrooms</li>
            <li>1 tbsp olive oil</li>
        </ul>

        <h2>Steps:</h2>
        <ol>
            <li>Preheat oven to 475°F (245°C)</li>
            <li>Roll out dough on a floured surface</li>
            <li>Transfer dough to baking sheet</li>
            <li>Spread tomato sauce evenly</li>
            <li>Add cheese and toppings</li>
            <li>Bake for 12-15 minutes until golden</li>
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
