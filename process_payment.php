<?php
session_start();

// Store session data if coming from POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tickets'])) $_SESSION['tickets'] = $_POST['tickets'];
    if (isset($_POST['buyer_name'])) $_SESSION['buyer_name'] = $_POST['buyer_name'];
    if (isset($_POST['buyer_phone'])) $_SESSION['buyer_phone'] = $_POST['buyer_phone'];
    if (isset($_POST['method'])) $_SESSION['payment_method'] = $_POST['method'];
}

$method = $_GET['method'] ?? $_SESSION['payment_method'] ?? 'Unknown';
$_SESSION['payment_method'] = $method;
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $method; ?> Payment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      text-align: center;
      padding: 50px;
    }
    .payment-box {
      width: 350px;
      background: white;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
      opacity: 0;
      animation: fadeIn 1s forwards;
    }
    h2 {
      margin-bottom: 20px;
    }
    input {
      width: 90%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
    }
    input:focus {
      border-color: #4CAF50;
      box-shadow: 0 0 5px rgba(76,175,80,0.5);
    }
    button {
      padding: 10px 20px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s;
    }
    button:hover {
      background: #388E3C;
    }
    button:active {
      transform: scale(0.98);
    }
    .hidden {
      display: none;
    }
    .confirm-message {
      font-size: 18px;
      color: green;
      margin-top: 20px;
      animation: slideUp 0.5s ease-in-out;
    }
    .confirm-message a button {
      margin-top: 15px;
    }

    @keyframes fadeIn {
      to { opacity: 1; }
    }
    @keyframes slideUp {
      from { transform: translateY(30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>

<div class="payment-box" id="paymentForm">
  <h2><?php echo htmlspecialchars($method); ?> Payment</h2>
  <form id="payForm" onsubmit="return simulatePayment();">

    <?php if ($method === 'Card'): ?>
      <input type="text" placeholder="Card Number" required><br>
      <input type="text" placeholder="Expiry Date (MM/YY)" required><br>
      <input type="text" placeholder="CVV" required><br>
    <?php else: ?>
      <input type="text" id="phone" placeholder="Phone Number" required><br>
      <input type="text" id="otp" placeholder="Enter OTP" class="hidden"><br>
      <input type="password" id="password" placeholder="Enter Password" class="hidden"><br>
    <?php endif; ?>

    <button type="submit">Confirm Payment</button>
  </form>

  <div class="confirm-message hidden" id="successMsg">
    ✅ Payment Successful!<br>
    <a href="receipt.php">
      <button>View Receipt</button>
    </a>
  </div>
</div>

<script>
function simulatePayment() {
  const method = "<?php echo $method; ?>";

  if (method === "Card") {
    showSuccess();
  } else {
    const phone = document.getElementById("phone");
    const otp = document.getElementById("otp");
    const password = document.getElementById("password");

    if (otp.classList.contains("hidden")) {
      otp.classList.remove("hidden");
      otp.focus();
      return false;
    }

    if (password.classList.contains("hidden")) {
      if (otp.value !== "1234") {
        alert("Invalid OTP. Use 1234 for demo.");
        return false;
      }
      password.classList.remove("hidden");
      password.focus();
      return false;
    }

    if (password.value.length < 4) {
      alert("Enter a valid password.");
      return false;
    }

    showSuccess();
  }

  return false;
}

function showSuccess() {
  document.getElementById('payForm').classList.add("hidden");
  document.getElementById('successMsg').classList.remove("hidden");

  // ✅ No redirect here — user clicks to go to receipt
}
</script>

</body>
</html>
