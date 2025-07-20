<?php
session_start();
include 'db.php'; // must be above insert

$tickets = $_SESSION['tickets'] ?? [];
$name = $_SESSION['buyer_name'] ?? '';
$phone = $_SESSION['buyer_phone'] ?? '';
$payment_method = $_SESSION['payment_method'] ?? ($_POST['method'] ?? 'Unknown');
$barcode = uniqid("TKT");
$total = 0;
$tickets_text = '';

foreach ($tickets as $ticket) {
    $line_total = $ticket['qty'] * $ticket['price'];
    $total += $line_total;
    $tickets_text .= "{$ticket['name']} x{$ticket['qty']}, ";
}
$tickets_text = rtrim($tickets_text, ', ');

// ✅ insert only if there's data
if (!empty($name) && !empty($tickets)) {
    $stmt = $conn->prepare("INSERT INTO ticket_sales 
        (buyer_name, phone, tickets, total_amount, payment_method, ticket_id) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $tickets_text, $total, $payment_method, $barcode);
    $stmt->execute();
    $stmt->close();
}



$tickets = $_SESSION['tickets'] ?? [];
$name = $_SESSION['buyer_name'] ?? '';
$phone = $_SESSION['buyer_phone'] ?? '';
$payment_method = $_SESSION['payment_method'] ?? ($_POST['method'] ?? 'Unknown');
$barcode = uniqid("TKT");
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Receipt</title>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Courier New', monospace;
      text-align: center;
      background: #f0f0f0;
      margin: 0;
      padding: 20px;
    }
    .receipt {
      width: 300px;
      margin: 20px auto;
      background: white;
      padding: 20px;
      border: 1px dashed #999;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      font-family: 'Brush Script MT', cursive;
      font-size: 28px;
    }
    .item {
      display: flex;
      justify-content: space-between;
      margin: 5px 0;
      font-size: 14px;
    }
    .total-line {
      font-weight: bold;
      margin-top: 10px;
      font-size: 16px;
      border-top: 1px dashed #333;
      padding-top: 5px;
    }
    .barcode {
      font-family: 'Libre Barcode 39', cursive;
      font-size: 36px;
      margin-top: 15px;
    }
    .note {
      font-size: 13px;
      margin-top: 10px;
      color: green;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background-color: #388E3C;
    }
  </style>
</head>
<body>

<div class="receipt" id="printArea">
  <h2> Ticket Receipt</h2>
  <h4> HSTU Zoo , Dinajpur-5200</h4>
  <p><strong>Name:<?php echo htmlspecialchars($name); ?></strong></p>
  <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
  <p>Date: <?php echo date("d-m-Y H:i"); ?></p>
  <p>Payment Method: <strong><?php echo htmlspecialchars($payment_method); ?></strong></p>
  <hr>

  <?php foreach ($tickets as $id => $ticket): 
    $line_total = $ticket['qty'] * $ticket['price'];
    $total += $line_total;
  ?>
    <div class="item">
      <span><?php echo htmlspecialchars($ticket['name']); ?> x<?php echo $ticket['qty']; ?></span>
      <span><?php echo number_format($line_total, 2); ?> BDT</span>
    </div>
  <?php endforeach; ?>

  <div class="total-line">
    <div class="item">
      <span>TOTAL</span>
      <span><?php echo number_format($total, 2); ?> BDT</span>
    </div>
  </div>

  <div class="barcode">*<?php echo $barcode; ?>*</div>
  <p class="note">Click the button below to download your receipt</p>

  <button onclick="downloadReceipt()">Download Receipt</button>
</div>

<!-- ✅ jsPDF for download + redirect on click -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  async function downloadReceipt() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let text = "HSTU Zoo Ticket Receipt\n";
    text += "---------------------------\n";
    text += "Name: <?php echo addslashes($name); ?>\n";
    text += "Phone: <?php echo addslashes($phone); ?>\n";
    text += "Date: <?php echo date("d-m-Y H:i"); ?>\n";
    text += "Payment: <?php echo addslashes($payment_method); ?>\n\n";

    <?php foreach ($tickets as $id => $ticket): ?>
      text += "- <?php echo addslashes($ticket['name']); ?> x<?php echo $ticket['qty']; ?> = <?php echo number_format($ticket['qty'] * $ticket['price'], 2); ?> BDT\n";
    <?php endforeach; ?>

    text += "\n---------------------------\n";
    text += "TOTAL: <?php echo number_format($total, 2); ?> BDT\n";
    text += "Ticket ID: <?php echo $barcode; ?>\n";
    text += "\nThank you for visiting HSTU Zoo!\n";

    doc.setFont("Courier", "normal");
    doc.setFontSize(12);
    doc.text(text, 10, 20);
    doc.save("Zoo_Receipt_<?php echo $barcode; ?>.pdf");

    // Redirect to homepage AFTER download
    window.location.href = "index.html";
  }
</script>

</body>
</html>
