<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] === 'student') {
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

$message = "";
if (isset($_POST['add_teacher'])) {
    $t_name = mysqli_real_escape_string($data, $_POST['name']);
    $t_description = mysqli_real_escape_string($data, $_POST['description']);

    $file = $_FILES['image'];
    $image_name = basename($file['name']);
    $image_tmp = $file['tmp_name'];

    $upload_dir = "./image/";
    $dst = $upload_dir . $image_name;
    $dst_db = "image/" . $image_name;

    // Create directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($image_tmp, $dst)) {
        $sql = "INSERT INTO teacher(name, description, image) 
                VALUES('$t_name', '$t_description', '$dst_db')";
        $result = mysqli_query($data, $sql);
        $message = $result ? "✅ Data uploaded successfully." : "❌ Data upload failed.";
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Teacher - Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 120px;
            padding-top: 10px;
            padding-bottom: 10px;
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
        <li><a href="view_teacher.php">View Teacher</a></li>
        <li><a href="add_course.php">Add Courses</a></li>
        <li><a href="view_course.php">View Courses</a></li>
    </ul>
</aside>

<center>
    <div class="content">
        <h1>Add Teacher</h1> <br>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="div_deg">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Teacher Name:</label>
                    <input type="text" name="name" required> <br>
                </div>
                <div>
                    <label>Description :</label>
                    <input type="text" name="description" required> <br>
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="file" name="image" accept="image/*" required> <br>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="add_teacher" value="Add Teacher"> <br>
                </div>
            </form>
        </div>
    </div>
</center>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
