<?php

  require_once "config.php";


  $mess = [];
  $errors = [];

 if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $uname = $_POST['uname'] ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if (!empty($uname) && !empty($password)) {
        if ($password === $password2) {
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES(?,?)");
            $stmt->bind_param('ss', $uname, $password);

          
            if ($stmt->execute()) {
                $mess[] = "Registered successfully. Please wait for the admin approval of your account";
            } else {
                $errors[] = "Something went wrong. Please try again later";
            }
            
            $stmt->close();
        } else {
            $errors[] = "Passwords should match";
        }
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h1> Inventory System </h1>
  <h2>Create your account</h2>
  <br>
  <?php foreach ($errors as $e): ?>
    <p style="color: red"><?php echo h($e); ?></p>
  <?php endforeach; ?>
  <br>
  <?php foreach ($mess as $m): ?>
    <p style="color: green"><?php echo h($m); ?></p>
  <?php endforeach; ?>

  <form action="" method="POST">
    <label for="uname">Username</label>
    <input type="text" name="uname" id="" placeholder="Enter username" required autofocus>
    <br><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="" placeholder="Enter password" required>
     <br><br>
    <label for="password">Re-enter Password:</label>
    <input type="password" name="password2" id="" placeholder="Re-Enter password" required>
     <br><br>
     <input type="submit" value="Register">
  </form>
  <br><br>
  <p>Already have an Account? <a href="index.php">Sign in</p>
</body>
</html>