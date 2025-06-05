<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['program'])) {
    $_SESSION['program'] = $_POST['program'];
} else {
    header("Location: select_program.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Payment Method</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 100px; }
        button { padding: 10px 20px; margin: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <h2>Program Selected: <?php echo $_SESSION['program']; ?></h2>
    <h3>Select Payment Method</h3>
    <form action="process_payment_method.php" method="POST">
        <button type="submit" name="method" value="bkash">Bkash</button>
        <button type="submit" name="method" value="nagad">Nagad</button>
        <button type="submit" name="method" value="card">Card</button>
        <button type="submit" name="method" value="rocket">Rocket</button>
    </form>
</body>
</html>
