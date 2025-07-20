<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Buy Zoo Tickets</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
    }
    h1 {
      text-align: center;
      margin-top: 30px;
    }
    form {
      max-width: 1000px;
      margin: auto;
    }
    .animal-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .animal-card {
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s ease;
    }
    .animal-card:hover {
      transform: translateY(-5px);
    }
    .animal-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }
    .quantity-control {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }
    .quantity-control button {
      padding: 5px 10px;
      font-size: 16px;
      border: none;
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
      border-radius: 4px;
      margin: 0 5px;
      transition: background-color 0.2s;
    }
    .quantity-control button:hover {
      background-color: #388E3C;
    }
    .quantity-control input {
      width: 40px;
      text-align: center;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 5px;
      transition: border-color 0.2s;
    }
    .quantity-control input:focus {
      border-color: #4CAF50;
      outline: none;
    }
    button.submit {
      margin: 20px auto;
      display: block;
      padding: 12px 24px;
      font-size: 16px;
      background: green;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button.submit:hover {
      background-color: darkgreen;
    }
  </style>
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

<h1>Buy Tickets For Each Animal</h1>

<form method="POST" action="payment.php">
  <div class="animal-grid">
    <?php
    $result = $conn->query("SELECT * FROM animals");
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $name = htmlspecialchars($row['name']);
      $image = htmlspecialchars($row['image']);
      echo "<div class='animal-card'>";
      echo "<img src='images/$image' alt='$name'>";
      echo "<h4>$name</h4>";
      echo "<div class='quantity-control'>";
      echo "<button type='button' onclick='decreaseQty($id)'>−</button>";
      echo "<input type='number' name='quantity[$id]' id='qty_$id' value='0' min='0'>";
      echo "<button type='button' onclick='increaseQty($id)'>+</button>";
      echo "</div>";
      echo "<input type='hidden' name='name[$id]' value='$name'>";
      echo "</div>";
    }
    ?>
  </div>
  <button type="submit" class="submit">Proceed to Payment</button>
</form>

<script>
  function increaseQty(id) {
    const input = document.getElementById('qty_' + id);
    input.value = parseInt(input.value || 0) + 1;
  }
  function decreaseQty(id) {
    const input = document.getElementById('qty_' + id);
    if (parseInt(input.value) > 0) {
      input.value = parseInt(input.value) - 1;
    }
  }
</script>
<!-- Footer -->
<footer class="site-footer">
  <div class="footer-content">
    <p><strong> <h4>Contact</h4></strong></p>
    <p>Hajee Mohammad Danesh Science & Technology University, Dinajpur, Bangladesh</p>
    <p>Email: info@hstuzoo.edu.bd | Phone: +880-1234-567890</p>
    <p> © 2025 HSTU Zoo. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
