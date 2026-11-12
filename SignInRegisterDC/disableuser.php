<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
  }

  if($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
  }

  $userid = $_GET['usersid'];

  $approveuser = mysqli_query($conn, "UPDATE  users SET status = 'pending' WHERE id = '$userid'");

  if($approveuser) {
    echo "
      <script>
        alert('User is disabled');

        window.location.href='users.php';
      </script>
    ";
  }
  else {
    echo "
    <script>
      alert('Something went wrong. Please try again later.');

      window.location.href='users.php';
    </script>
    ";
  }

?>

