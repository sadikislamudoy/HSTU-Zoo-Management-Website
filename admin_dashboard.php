<?php include 'db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel - Ticket Sales</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; padding: 20px; }
    table { border-collapse: collapse; width: 100%; background: white; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #4CAF50; color: white; }
    h2 { text-align: center; margin-bottom: 20px; }
  </style>
</head>
<body>
    <div style="text-align: right; margin: 10px 30px 0 0;">
  <a href="admin_logout.php" style="
    background: #e74c3c;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
  ">
    Logout
  </a>
</div>


<h2>Ticket Sales Report</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Tickets</th>
    <th>Total</th>
    <th>Payment Method</th>
    <th>Date</th>
  </tr>
  <?php
    $result = $conn->query("SELECT * FROM ticket_sales ORDER BY purchase_date DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".htmlspecialchars($row['buyer_name'])."</td>
            <td>".htmlspecialchars($row['phone'])."</td>
            <td>".htmlspecialchars($row['tickets'])."</td>
            <td>".number_format($row['total_amount'],2)."</td>
            <td>".htmlspecialchars($row['payment_method'])."</td>
            <td>".$row['purchase_date']."</td>
        </tr>";
    }
  ?>
</table>

</body>
</html>
