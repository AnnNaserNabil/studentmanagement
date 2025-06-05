<?php
// সেশন চেক
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

// ডাটাবেজ কানেকশন
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;
$conn = mysqli_connect($host, $user, $password, $db, $port);

// POST রিকোয়েস্ট মানে ফর্ম সাবমিট হয়েছে
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id       = $_POST['id'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];

    // Prepare & Execute
    $sql = "UPDATE user SET username=?, email=?, phone=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $phone, $password, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_student.php?msg=updated");
        exit();
    } else {
        echo "Update failed.";
    }
}

// GET রিকোয়েস্ট মানে ইউজারের ইনফো লোড করতে হবে
$info = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $info = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($info['id']); ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($info['username']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?php echo htmlspecialchars($info['password']); ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="view_student.php" class="btn btn-default">Cancel</a>
        </form>
    </div>
</body>
</html>
