<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
    exit;
  }

  $productid = $_GET['productid'];

  $fetchproduct = mysqli_query($conn, "SELECT * FROM products WHERE id = '$productid'");

  if(mysqli_num_rows($fetchproduct) === 0 ) {
    echo "
      <script>
        alert('No product found with that ID!');

        window.location.href='products.php';
      </script>
    ";
  }

  $product = mysqli_fetch_assoc($fetchproduct);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <style>
    form div {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    form {
      display: flex;
      flex-direction: row;
      gap: 20px;
    }
  </style>
</head>
<body>
  <h3> Edit Product ID <?php echo $product['id']?></h3>
        <br>
        <form action="" method="POST">
          <div>
            <div>
            <label for=""> Product Name </label>
            <input type="text" name="product_name" id="" required value='<?php echo $product['name']?>'>
          </div>
          <div>
            <label for=""> Description </label>
            <textarea name="description" id="" cols="50" rows="5" required><?php echo $product['description'] ?></textarea>
          </div>
          </div>
          <div>
            <div>
            <label for=""> Quantity </label>
            <input type="number" name="quantity" id="" required value='<?php echo $product['quantity'] ?>'>
          </div>
          <div>
            <label for=""> Price </label>
            <input type="number" name="price" id="" required value='<?php echo $product['price'] ?>'>
          </div>
          <br>
          <div>
            <input type="submit" value="Save Product" name="savebtn">
          </div>
          </div>
        </form>
</body>
</html>


<?php 

      if(isset($_POST['savebtn'])) {
        $name =  $_POST['product_name'];
        $desc =  $_POST['description'];
        $q =  $_POST['quantity'];
        $price =  $_POST['price'];

       

        $updatequery = "UPDATE products SET name='$name', description='$desc', quantity='$q', price='$price' WHERE id ='$productid'";
        $updatefunc = mysqli_query($conn, $updatequery);
        
        if($updatefunc) {
          echo "
            <script>
              alert('Product saved successfully');
              
              window.location.href='products.php';
            </script>
          ";
        } else {
           echo "
            <script>
              alert('Something went wrong. Please try again later!');
              
              window.location.href='products.php';
            </script>
          ";
        }
      }

?>