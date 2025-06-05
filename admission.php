<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);
$sql = "SELECT * FROM admission";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="table.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

    <header class="header">
        <a href="">Admin Dashboard</a>
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
            <li><a href="">View Teacher</a></li>
            <li><a href="">Add Courses</a></li>
            <li><a href="">View Courses</a></li>
        </ul>
    </aside>

    <div class="content">
        <h1>Applied For Admission</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>

            <?php while ($info = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($info['name']); ?></td>
                    <td><?php echo htmlspecialchars($info['email']); ?></td>
                    <td><?php echo htmlspecialchars($info['phone']); ?></td>
                    <td><?php echo htmlspecialchars($info['message']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

