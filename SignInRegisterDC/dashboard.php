<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
  }

  $totaluser = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
  $totalpending = $conn->query("SELECT COUNT(*) AS total FROM users WHERE status  = 'pending'")->fetch_assoc()['total'];
  $totalproduct = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .nav{
      display: flex;
      flex-direction: row;
      gap: 20px;
    }
    .nav a {
      text-decoration: none;
      color: black;
    }
    .nav a:hover{
      text-decoration: underline;
      color: green;
    }
    .cards {
      display: flex;
      flex-direction: none;
      gap: 20px;
    }
    .card {
      width: 250px;
      border: 1px solid black;
      text-align: center;
      color: white;
    }
 </style>
</head>
<body>
    <div class="nav">
      <a href="dashboard.php"> Dashboard</a>
      <a href="products.php"> Products </a>
      <?php if ($_SESSION['role'] === 'admin'):?>
      <a href="users.php"> Users Management </a>
      <?php endif; ?>
      <a href="logout.php"> Logout </a>
    </div>

    <br>

    <div class="main">
      <h1> Welcome! </h1>
      <br>
      <div class="cards">
        <div class="card" style="background-color: blue;">
          <h3> Total of Users </h3>
          <h2><?php echo $totaluser?></h2>
        </div>
        <div class="card" style="background-color: orange;">
          <h3> Total of Not Approved Users </h3>
          <h2><?php echo $totalpending?></h2>
        </div>
        <div class="card" style="background-color: green;">
          <h3> Total of Products </h3>
          <h2><?php echo $totalproduct?></h2>
        </div>
      </div>

    </div>

</body>
</html>