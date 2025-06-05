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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id='$id'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        header("Location: view_student.php?msg=deleted");
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "No ID provided.";
}
?>
