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
if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // পূর্বে ইমেজ ফাইল ডিলিট করা (ঐচ্ছিক কিন্তু ভালো অভ্যাস)
    $get_image = mysqli_query($data, "SELECT image FROM teacher WHERE id=$id");
    $row = mysqli_fetch_assoc($get_image);
    if ($row && file_exists($row['image'])) {
        unlink($row['image']);
    }

    $sql = "DELETE FROM teacher WHERE id=$id";
    $result = mysqli_query($data, $sql);

    if ($result) {
        header("Location: view_teacher.php");
        exit();
    } else {
        echo "Delete failed!";
    }
} else {
    echo "Invalid request!";
}
?>
