<?php
  require_once 'config.php';
  
  if($_SESSION['role'] === '' || $_SESSION['user_id'] === '') {
    header('Location: index.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <style>
    .nav{
      display: flex;
      flex-direction: row;
      gap: 20px;
    }
    .nav a{
      text-decoration: none;
      color: black;
    }
    .nav a:hover {
      text-decoration: underline;
      color: green;
    }

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

    table, th, tr, td {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 70%;
    }

    th {
      background-color: salmon;
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
    <a href="logout.php"> logout </a>
  </div>

  <div class="main">
      <div>
        <h3> Add Product </h3>
        <br>
        <form action="" method="POST">
          <div>
            <div>
            <label for=""> Product Name </label>
            <input type="text" name="product_name" id="" required>
          </div>
          <div>
            <label for=""> Description </label>
            <textarea name="description" id="" cols="50" rows="5" required></textarea>
          </div>
          </div>
          <div>
            <div>
            <label for=""> Quantity </label>
            <input type="number" name="quantity" id="" required>
          </div>
          <div>
            <label for=""> Price </label>
            <input type="number" name="price" id="" required>
          </div>
          <br>
          <div>
            <input type="submit" value="Add Product" name="addproductbtn">
          </div>
          </div>
        </form>
      </div>
      <br>
      <hr>
      <br>
      <div>
        <h1> Products List </h1>
        <br>
        <table>
          <thead>
            <tr>
              <th> ID </th>
              <th> Name </th>
              <th> Description </th>
              <th> Quantity </th>
              <th> Price </th>
              <th> Date Saved </th>
              <th> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
              $fetchproduct = mysqli_query($conn, "SELECT * FROM products");

              if(mysqli_num_rows($fetchproduct)>0) {
                while($product = mysqli_fetch_assoc($fetchproduct)) {
                  ?>
                    <tr>
                      <td><?php echo $product['id']; ?></td>
                      <td><?php echo $product['name']; ?></td>
                      <td><?php echo $product['description']; ?></td>
                      <td><?php echo $product['quantity']; ?></td>
                      <td><?php echo $product['price']; ?></td>
                      <td><?php echo $product['created_at']; ?></td>
                      <td>
                        <button onclick="window.location.href='editproduct.php?productid=<?php echo $product['id'] ?>'"> Edit </button>
                        <button onclick="window.location.href='deleteproduct.php?productid=<?php echo $product['id'] ?>'"> Delete </button>
                      </td>
                    </tr>
                  <?php
                }
              }else {
                ?>
                  <tr>
                    <td colspan="7"> No Products </td>
                  </tr>

                  <?php
              }
              ?>
          </tbody>
        </table>
      </div>
  </div>
</body>
</html>


<?php 

      if(isset($_POST['addproductbtn'])) {
        $name =  $_POST['product_name'];
        $desc =  $_POST['description'];
        $q =  $_POST['quantity'];
        $price =  $_POST['price'];

        $userid = $_SESSION['user_id'];

        $insertquery = "INSERT INTO products (name, description, quantity, price, created_by) VALUES('$name','$desc','$q','$price','$userid')";
        $insertfunc = mysqli_query($conn, $insertquery);
        
        if($insertfunc) {
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