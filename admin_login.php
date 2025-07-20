<?php
session_start();

$admin_user = 'admin';
$admin_pass = '123456'; // 🔒 You can change this to anything you like

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; text-align: center; padding: 100px; }
    .login-box {
      background: white;
      display: inline-block;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }
    input { padding: 10px; margin: 10px; width: 200px; }
    button { padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
