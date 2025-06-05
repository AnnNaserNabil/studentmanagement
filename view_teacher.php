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

// Fetch teacher data
$sql = "SELECT * FROM teacher ORDER BY id DESC";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Teachers - Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .table_th {
            padding: 12px;
            font-size: 16px;
            text-align: center;
        }
        .table_td {
            padding: 12px;
            background-color: skyblue;
            text-align: center;
        }
        .action-btn {
            margin-right: 5px;
        }
        .teacher-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .table {
            width: 95%;
            margin: auto;
            margin-top: 20px;
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

<div class="content">
    <h1>All Teachers</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="table_th">Teacher Name</th>
                <th class="table_th">Description</th>
                <th class="table_th">Image</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td class="table_td"><?= htmlspecialchars($row['name']) ?></td>
                    <td class="table_td"><?= htmlspecialchars($row['description']) ?></td>
                    <td class="table_td">
                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Teacher Image" class="teacher-image">
                    </td>
  

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
