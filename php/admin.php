<?php 
  
  session_start();
  include_once('adminheader.php');
  
  // Enable error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Recipe Corner</title>
  <link rel="stylesheet" type="text/css" href="../css/admin.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <main class="admin">
      <h1 class="display-1">ADMIN PANEL</h1>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Recipes</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <th scope="col">Blog</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            $r = mysqli_query($conn, "SELECT * FROM posts");
            while($rowData = mysqli_fetch_array($r)) {
          ?>
          <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo htmlspecialchars($rowData['title']); ?></td>
            <td>
              <a href="admin-edit.php?id=<?php echo $rowData['id']; ?>">
                <i class="fa fa-pencil"></i>
              </a>
            </td>
            <td>
              <a href="delete.php?id=<?php echo $rowData['id']; ?>">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php $i++; } ?>
        </tbody>
      </table>
    </main>
    <?php include_once('footer.php'); ?>
  </div> <!-- .wrapper -->
</body>
</html>
