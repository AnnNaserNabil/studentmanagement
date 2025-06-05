<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);

$id = mysqli_real_escape_string($data, $_GET['id']);
$sql = "SELECT * FROM user WHERE id='$id'";

$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
            <div class="form-group">
                <label>username</label>
                <input type="text" name="username" value="<?php echo $info['username']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $info['email']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo $info['phone']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?php echo $info['password']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Edited</button>
            <a href="view_student.php" class="btn btn-default">Cancel</a>
        </form>
    </div>
</body>
</html>
