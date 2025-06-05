<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);
if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = $_POST['password'];
    $usertype = "student";

    // Basic security: trim inputs and escape special chars
    $username = mysqli_real_escape_string($data, trim($username));
    $user_email = mysqli_real_escape_string($data, trim($user_email));
    $user_phone = mysqli_real_escape_string($data, trim($user_phone));
    $user_password = mysqli_real_escape_string($data, trim($user_password));

    $sql = "INSERT INTO user(username, email, phone, usertype, password)
            VALUES('$username', '$user_email', '$user_phone', '$usertype', '$user_password')";

    $result = mysqli_query($data, $sql);

    $message = $result ? "✅ Data uploaded successfully." : "❌ Data upload failed.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Student - Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type ="text/css">
        label {
 display: inline-block;
 text-align : right;
 width: 100px;
 padding-top:10px;
 padding-bottom:10px;
        }
    </style>
</head>

<body>

<header class="header">
    <a href="#">Admin Home</a>
    <div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</header>

<aside>
    <ul>
        <li><a href="admission.php">Admission</a></li>
        <li><a href="Add_Student.php">Add Student</a></li>
        <li><a href="view_student.php">View Student</a></li>
        <li><a href="add_teacher.php">Add Teacher</a></li>
        <li><a href="#">View Teacher</a></li>
        <li><a href="#">Add Courses</a></li>
        <li><a href="#">View Courses</a></li>
    </ul>
</aside>
<center>
<div class="content">
    <h1>Add Student</h1>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
<div class="div_deg">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{11}" placeholder="01XXXXXXXXX" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" class="btn btn-primary" name="add_student" value="Add Student">
        </div>
    </form>
</div>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

