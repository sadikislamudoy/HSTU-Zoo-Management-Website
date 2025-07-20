<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>HSTU Zoo - Animals</title>
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


<h1>Visit Our Animals</h1>

<div class="search-bar">
  <form method="GET">
    <input type="text" name="search" placeholder="Search animals...">
    <button type="submit">Search</button>
  </form>
</div>

<div class="animal-cards">
<?php
$search = '';
if (isset($_GET['search'])) {
  $search = $conn->real_escape_string($_GET['search']);
  $sql = "SELECT * FROM animals WHERE name LIKE '%$search%' OR description LIKE '%$search%' OR info LIKE '%$search%'";
} else {
  $sql = "SELECT * FROM animals";
}
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $name = $row['name'];
  $desc = isset($row['description']) ? $row['description'] : '';
  $info = isset($row['info']) ? $row['info'] : '';
  $img = $row['image'];

  // Proper escaping using json_encode
  $name_js = json_encode($name);
  $desc_js = json_encode($desc);
  $info_js = json_encode($info);
  $img_js = json_encode($img);
  ?>
  <div class='animal-card' onclick='showAnimalModal(<?php echo $name_js; ?>, <?php echo $desc_js; ?>, <?php echo $info_js; ?>, <?php echo $img_js; ?>)'>
    <img src='images/<?php echo htmlspecialchars($img); ?>' alt='<?php echo htmlspecialchars($name); ?>'>
    <h3><?php echo htmlspecialchars($name); ?></h3>
  </div>
  <?php
}
?>
</div>

<!-- Modal -->
<div id="animalModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Animal Image" style="width:100%; border-radius:10px; max-height:200px; object-fit:cover;">
    <h2 id="modalTitle"></h2>
    <p id="modalDescription"></p>
    <p id="modalInfo"></p>
  </div>
</div>

<!-- Footer -->
<footer class="site-footer">
  <div class="footer-content">
    <p><strong> <h4>Contact</h4></strong></p>
    <p>Hajee Mohammad Danesh Science & Technology University, Dinajpur, Bangladesh</p>
    <p>Email: info@hstuzoo.edu.bd | Phone: +880-1234-567890</p>
    <p> © 2025 HSTU Zoo. All rights reserved.</p>
  </div>
</footer>

<!-- JavaScript -->
<script>
function showAnimalModal(name, description, info, image) {
  document.getElementById('modalTitle').innerText = name;
  document.getElementById('modalDescription').innerText = description;
  document.getElementById('modalInfo').innerText = "Info: " + info;
  document.getElementById('modalImage').src = "images/" + image;
  document.getElementById('animalModal').style.display = "block";
}

function closeModal() {
  document.getElementById('animalModal').style.display = "none";
}

window.onclick = function(event) {
  const modal = document.getElementById('animalModal');
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
