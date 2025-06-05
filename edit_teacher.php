<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);
if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM teacher WHERE id=$id";
$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);

if (isset($_POST['update_teacher'])) {
    $t_name = $_POST['name'];
    $t_description = $_POST['description'];

    // যদি নতুন ছবি আপলোড করা হয়
    if ($_FILES['image']['name']) {
        $file = $_FILES['image'];
        $image_name = $file['name'];
        $image_tmp = $file['tmp_name'];
        $dst = "./image/" . $image_name;
        $dst_db = "image/" . $image_name;

        move_uploaded_file($image_tmp, $dst);
    } else {
        $dst_db = $info['image'];
    }

    $update_query = "UPDATE teacher SET name='$t_name', description='$t_description', image='$dst_db' WHERE id=$id";
    $update_result = mysqli_query($data, $update_query);

    if ($update_result) {
        header("Location: view_teacher.php");
        exit();
    } else {
        echo "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
</head>
<body>
    <h2>Edit Teacher Info</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($info['name']) ?>" required><br><br>

        <label>Description:</label>
        <input type="text" name="description" value="<?= htmlspecialchars($info['description']) ?>" required><br><br>

        <label>Image:</label>
        <input type="file" name="image"><br>
        <small>Current Image: <img src="<?= $info['image'] ?>" width="80"></small><br><br>

        <input type="submit" name="update_teacher" value="Update">
    </form>
</body>
</html>
