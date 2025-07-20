<?php
session_start();

// Safely store POST values only if they exist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tickets'])) {
        $_SESSION['tickets'] = $_POST['tickets'];
    }

    if (isset($_POST['buyer_name'])) {
        $_SESSION['buyer_name'] = $_POST['buyer_name'];
    }

    if (isset($_POST['buyer_phone'])) {
        $_SESSION['buyer_phone'] = $_POST['buyer_phone'];
    }

    if (isset($_POST['method'])) {
        $_SESSION['payment_method'] = $_POST['method'];
    }
}

// Get selected method (either from session or URL)
$method = $_GET['method'] ?? $_SESSION['payment_method'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Select Payment Method</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      text-align: center;
      padding-top: 40px;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      margin-bottom: 20px;
    }

    .method {
      display: flex;
      flex-direction: column;
      gap: 15px;
      align-items: center;
    }

    .method form {
      width: 80%;
    }

    .method button {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px;
      font-size: 16px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .method button:hover {
      background-color: #388E3C;
    }

    .method button img {
      width: 24px;
      height: 24px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Select Payment Method</h2>
  <p>Please choose how you would like to pay for your zoo tickets.</p>

  <div class="method">
    <form method="GET" action="process_payment.php">
      <input type="hidden" name="method" value="Card">
      <button type="submit">
        <img src="images/card.png" alt="Card"> Card
      </button>
    </form>

    <form method="GET" action="process_payment.php">
      <input type="hidden" name="method" value="Bkash">
      <button type="submit">
        <img src="images/bkash.png" alt="Bkash"> Bkash
      </button>
    </form>

    <form method="GET" action="process_payment.php">
      <input type="hidden" name="method" value="Nagad">
      <button type="submit">
        <img src="images/nagad.png" alt="Nagad"> Nagad
      </button>
    </form>

    <form method="GET" action="process_payment.php">
      <input type="hidden" name="method" value="Rocket">
      <button type="submit">
        <img src="images/rocket.png" alt="Rocket"> Rocket
      </button>
    </form>

    <form method="GET" action="process_payment.php">
      <input type="hidden" name="method" value="Upay">
      <button type="submit">
        <img src="images/upay.png" alt="Upay"> Upay
      </button>
    </form>
  </div>
</div>

</body>
</html>
