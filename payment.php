<?php
$quantities = $_POST['quantity'] ?? [];
$names = $_POST['name'] ?? [];

$selected = [];
foreach ($quantities as $id => $qty) {
  if ((int)$qty > 0) {
    $selected[$id] = [
      'name' => $names[$id],
      'qty' => (int)$qty,
      'price' => 100
    ];
  }
}
if (empty($selected)) {
  die("No tickets selected. <a href='tickets.php'>Go back</a>");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Confirm Tickets</title>
  <style>
    body { font-family: Arial; text-align: center; }
    .summary { margin: 20px auto; width: 400px; text-align: left; }
    .summary table { width: 100%; border-collapse: collapse; }
    .summary th, .summary td { padding: 8px; border-bottom: 1px solid #ccc; }
    .form-box { margin-top: 30px; }
    input { padding: 8px; width: 80%; margin-bottom: 10px; }
    button {
      padding: 10px 20px;
      background: green;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<h2>Review Your Ticket Order</h2>

<div class="summary">
  <table>
    <tr><th>Animal</th><th>Qty</th><th>Price</th><th>Total</th></tr>
    <?php $grandTotal = 0; ?>
    <?php foreach ($selected as $id => $info): 
      $subtotal = $info['qty'] * $info['price'];
      $grandTotal += $subtotal;
    ?>
      <tr>
        <td><?php echo $info['name']; ?></td>
        <td><?php echo $info['qty']; ?></td>
        <td>100</td>
        <td><?php echo number_format($subtotal, 2); ?></td>
      </tr>
    <?php endforeach; ?>
    <tr><th colspan="3">Total</th><th><?php echo number_format($grandTotal, 2); ?></th></tr>
  </table>
</div>

<form method="POST" action="pay_method.php" class="form-box">
  <input type="text" name="buyer_name" placeholder="Your Name" required><br>
  <input type="text" name="buyer_email" placeholder="Email" required><br>

  <?php foreach ($selected as $id => $info): ?>
    <input type="hidden" name="tickets[<?php echo $id; ?>][name]" value="<?php echo $info['name']; ?>">
    <input type="hidden" name="tickets[<?php echo $id; ?>][qty]" value="<?php echo $info['qty']; ?>">
    <input type="hidden" name="tickets[<?php echo $id; ?>][price]" value="<?php echo $info['price']; ?>">
  <?php endforeach; ?>

  <button type="submit">Pay</button>
</form>


</body>
</html>