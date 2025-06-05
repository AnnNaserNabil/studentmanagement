<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);
if (!$data) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style>
        .table_th {
            padding: 12px;
            font-size: 16px;
        }
        .table_td {
            padding: 12px;
            background-color: skyblue;
        }
        .action-btn {
            margin-right: 5px;
        }
    </style>

    <!-- External CSS -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="table.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<header class="header">
    <a href="#">Admin Dashboard</a>
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

<div class="content" style="padding: 20px;">
    <h1>Student Information</h1>

    <div style="margin-bottom: 15px;">
        
        <a href="export_excel.php" class="btn btn-success" style="margin-left: 10px;">Export to Excel</a>
        <a href="export_pdf.php" class="btn btn-danger">Export to PDF</a>
    </div>

    <table class="table table-bordered" id="userTable">
        <thead>
            <tr>
                <th class="table_th">Username</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Password</th>
                <th class="table_th">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($info = $result->fetch_assoc()) { ?>
                <tr>
                    <td class="table_td"><?php echo htmlspecialchars($info['username']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['email']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['phone']); ?></td>
                    <td class="table_td">••••••••</td>
                    <td class="table_td">
                        <a href="edit_user.php?id=<?php echo $info['id']; ?>" class="btn btn-sm btn-warning action-btn">Edit</a>
                        <a href="delete_user.php?id=<?php echo $info['id']; ?>" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure to delete this user?')">Delete</a>
                        <a href="update_user.php?id=<?php echo $info['id']; ?>" class="btn btn-sm btn-info action-btn" onclick="return confirm('Are you sure to update this user?')">Update</a>
                        <a href="export_excel.php?id=<?php echo $info['id']; ?>" class="btn btn-sm btn-success action-btn">Export</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
