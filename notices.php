<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>HSTU Zoo - Notices</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Top header -->
<div class="top-header">
  <div class="logo-left">
    <img src="zoo-logo.png" alt="HSTU Zoo Logo">
    <span class="site-title">Hajee Mohammad Danesh Science & Technology University Zoo</span>
  </div>
  <div class="nav-right">
    <a href="index.html">Home</a>
    <a href="animals.php">Animals</a>
    <a href="tickets.php">Tickets</a>
    <a href="notices.php">Notices</a>
     <a href="admin_portal.php">Admin Login</a> <!-- ✅ NEW -->


  </div>
</div>


<h1>Zoo Notices</h1>

<div class="notices">
<?php
$result = $conn->query("SELECT * FROM notices ORDER BY date DESC");

while($row = $result->fetch_assoc()) {
  echo "<div class='notice'>";
  echo "<p>{$row['message']}</p>";
  echo "<small>Date: {$row['date']}</small>";
  echo "</div>";
}
?>
</div>
<div>
  <h1>Thank You for Visiting!</h1>
  <h4>We hope you enjoyed your visit to the HSTU Zoo. Stay tuned for more updates and events.</h4>
</div>

<!-- Footer -->
<footer class="site-footer">
  <div class="footer-content">
    <p><strong><h4>Contact</h4></strong></p>
    <p>Hajee Mohammad Danesh Science & Technology University, Dinajpur, Bangladesh</p>
    <p>Email: info@hstuzoo.edu.bd | Phone: +880-1234-567890</p>
    <p>© 2025 HSTU Zoo Management System. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
