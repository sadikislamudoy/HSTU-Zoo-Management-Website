<!-- admin_portal.php -->
<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
  header("Location: admin_dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Portal - HSTU Zoo</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; text-align: center; padding: 80px; }
    .portal-box {
      display: inline-block;
      padding: 40px;
      background: white;
      box-shadow: 0 0 10px #ccc;
      border-radius: 10px;
    }
    h2 { margin-bottom: 20px; }
    a.button {
      display: inline-block;
      margin-top: 20px;
      background: #4CAF50;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    a.button:hover {
      background: #388E3C;
    }
  </style>
</head>
<body>

<div class="portal-box">
  <h2>Welcome to HSTU Zoo Admin Portal</h2>
  <p>This panel is for authorized staff only.</p>
  <a class="button" href="admin_login.php">Proceed to Login</a>
</div>

</body>
</html>
