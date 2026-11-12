<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
  }

  if($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Managements</title>
  <style>
    .nav {
      display: flex;
      flex-direction: row;
      gap: 20px;
    }
    .nav a {
      text-decoration: none;
      color: black;
    }
    .nav a:hover {
      text-decoration: underline;
      color: green;
    }
    table, th, tr, td {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 70%;
    }

    th {
      background-color: lightblue;
      padding: 5px;
    }

    td {
      text-align: center;
      padding: 5px;
    }
  </style>
</head>
<body>
  <div class="nav">
    <a href="dashboard.php"> Dashboard </a>
    <a href="products.php"> Products </a>
    <?php if ($_SESSION['role'] === 'admin'):?>
      <a href="users.php"> Users </a>
    <?php endif; ?>
    <a href="logout.php"> Logout </a>
  </div>
  <br>
  <div class="main">
    <h1> User Management </h1>
    <br>
    <table>
      <thead>
        <tr>
          <th> Username </th>
          <th> Status </th>
          <th> Role </th>
          <th> Data Created </th>
          <th> Action </th>
        </tr>
      </thead>
      <tbody>
        <?php
          $fetchquery = "SELECT * FROM users";
          $fetch = mysqli_query($conn, $fetchquery);   
          
          if(mysqli_num_rows($fetch) > 0) {
            while($user = mysqli_fetch_assoc($fetch)) {
              ?>
                <tr>
                  <td><?php echo $user['username']; ?></td>
                  <td><?php echo $user['status']; ?></td>
                  <td><?php echo $user['role']; ?></td>
                  <td><?php echo $user['created_at']; ?></td>
                  <td>
                    <?php if($user['status'] !== 'approved'): ?>
                    <button onclick="window.location.href='approveuser.php?userid=<?php echo $user['id']; ?> ?>'"> Approve </button>
                    <?php elseif($user['status'] === 'approved'): ?>
                      <button onclick="window.location.href='disableuser.php?userid=<?php echo $user['id']; ?> ?>'"> Disable </button>
                    <?php endif; ?>
                    </td>
                </tr>
              <?php
            }
          }
          else {
            ?>
              <tr>
                <td colspan="5">No Users Found.</td>
              </tr>
       <?php
          }
        ?>
      </tbody>
    </table>

  </div>
</body>
</html>