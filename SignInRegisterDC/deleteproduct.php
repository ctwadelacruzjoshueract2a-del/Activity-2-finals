<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
    exit;
  }

  $productid = $_GET['productid'];

  $deleteproduct = mysqli_query($conn, "DELETE FROM products WHERE id= '$productid'");

  if($deleteproduct) {
    echo "
      <script>
        alert('Deleted successfully');

        window.location.href='products.php';
      </script>
    ";
  }
  else {
    echo "
    <script>
      alert('Something went wrong. Please try again later.');

      window.location.href='products.php';
    </script>
    ";
  }

?>

