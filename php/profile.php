<?php
session_start();
include_once('header.php');
require_once 'connect.php';

if (!isset($_SESSION['u_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['u_id'];

// Retrieve user details
$userQuery = "SELECT * FROM users WHERE id = '$userId'";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

// Count recipes posted by the user (assuming "name" is unique in posts table)
$recipesQuery = "SELECT COUNT(*) AS count FROM posts WHERE username = '" . mysqli_real_escape_string($conn, $userData['name']) . "'";
$recipesResult = mysqli_query($conn, $recipesQuery);
$recipesData = mysqli_fetch_assoc($recipesResult);
$recipesCount = $recipesData['count'];

// For now, we'll assume blogs posted is not tracked separately.
$blogsCount = 0;

// Fetch bookmarked recipes
$bookmarksQuery = "SELECT b.recipe_id, r.title, r.image FROM bookmarks b JOIN posts r ON b.recipe_id = r.id WHERE b.user_id = '$userId'";
$bookmarksResult = mysqli_query($conn, $bookmarksQuery);
?>

<!-- Inline CSS to enhance the table styling and profile image -->
<style>
.table-custom {
    border-collapse: separate;
    border-spacing: 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
}
.table-custom th, .table-custom td {
    border: none;
    padding: 12px 15px;
}
.table-custom th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #333;
}
.table-custom tr {
    border-bottom: 1px solid #dee2e6;
}
.table-custom tr:last-child {
    border-bottom: none;
}
.table-custom tr:hover {
    background-color: #f1f1f1;
}

.profile-img-container {
    text-align: center;
    margin-bottom: 15px;
}
.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
}

.bookmarks-table img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
    vertical-align: middle;
}
.bookmarks-table a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s;
}
.bookmarks-table a:hover {
    color: tomato;
}
</style>

<div class="container mt-5">
  <h2 class="text-center mb-4">User Profile</h2>
  <table class="table table-bordered table-striped table-custom">
    <tbody>
      <tr>
        <td colspan="2" class="profile-img-container">
          <?php if (!empty($userData['profile_image'])) { ?>
            <img src="../uploads/<?php echo htmlspecialchars($userData['profile_image']); ?>" alt="Profile Image" class="profile-img">
          <?php } else { ?>
            <img src="../images/default-profile.png" alt="Default Profile Image" class="profile-img">
          <?php } ?>
        </td>
      </tr>
      <tr>
        <th scope="row">Name</th>
        <td><?php echo htmlspecialchars($userData['name']); ?></td>
      </tr>
      <tr>
        <th scope="row">Email</th>
        <td><?php echo htmlspecialchars($userData['email']); ?></td>
      </tr>
      <tr>
        <th scope="row">Mobile Number</th>
        <td><?php echo htmlspecialchars($userData['mobile']); ?></td>
      </tr>
      <tr>
        <th scope="row">Recipes Posted</th>
        <td><?php echo $recipesCount; ?></td>
      </tr>
      <tr>
        <th scope="row">Blogs Posted</th>
        <td><?php echo $blogsCount; ?></td>
      </tr>
    </tbody>
  </table>

  <!-- Bookmarked Recipes Table -->
  <h3 class="text-center mt-5 mb-4">Bookmarked Recipes</h3>
  <table class="table table-bordered table-striped table-custom bookmarks-table">
    <thead>
      <tr>
        <th>Recipe</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($bookmarksResult) > 0) { ?>
        <?php while ($bookmark = mysqli_fetch_assoc($bookmarksResult)) { ?>
          <tr>
            <td>
              <img src="../images/<?php echo htmlspecialchars($bookmark['image']); ?>" alt="<?php echo htmlspecialchars($bookmark['title']); ?>">
              <a href="recipe-individual.php?id=<?php echo $bookmark['recipe_id']; ?>">
                <?php echo htmlspecialchars($bookmark['title']); ?>
              </a>
            </td>
            <td>
              <a href="remove-bookmark.php?recipe_id=<?php echo $bookmark['recipe_id']; ?>" class="btn btn-danger btn-sm">Remove</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="2" class="text-center">No bookmarks found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include_once('footer.php'); ?>