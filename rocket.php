<?php
$program = $_GET['program'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rocket Payment</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        body { font-family: Arial; text-align: center; margin-top: 60px; }
        input, button { padding: 10px; margin: 10px; width: 250px; }
    </style>
</head>
<body class="rocket-page">
    <h2>Rocket Payment for <?= htmlspecialchars($program) ?></h2>
    <form method="POST">
        <input type="hidden" name="program" value="<?= htmlspecialchars($program) ?>">
        <input type="text" name="transaction_id" placeholder="Transaction ID" required><br>
        <input type="text" name="rocket_number" placeholder="Rocket Number" required><br>
        <input type="number" name="amount" step="0.01" placeholder="Amount" required><br>
        <button type="submit" name="submit">Submit Payment</button>
    </form>

<?php
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "schoolproject");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $program = $_POST['program'];
    $txn = $_POST['transaction_id'];
    $number = $_POST['rocket_number'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO rocket_payment (program_type, transaction_id, amount, rocket_number)
            VALUES ('$program', '$txn', '$amount', '$number')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>✅ Payment Successful!</p>";
    } else {
        echo "<p>❌ Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>
</body>
</html>
