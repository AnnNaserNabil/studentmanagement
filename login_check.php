<?php 
error_reporting(0);
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);

if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($data, $_POST['username']);
    $pass = mysqli_real_escape_string($data, $_POST['password']);


    $sql = "SELECT * FROM parent WHERE username = ?";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch user data
    $row = mysqli_fetch_assoc($result);

    if ($row) { // Check if username exists
        if ($row["password"] == $pass) { // Check if password is correct
            $_SESSION['username'] = $name;
            $_SESSION['usertype'] = $row["usertype"];

          
            if ($row["usertype"] == "admin") {
                header("location:adminhome.php");
                exit();
               
            } else {
                $_SESSION['loginMessage'] = "Invalid user type.";
                header("location:login.php");
         exit();
            }
        } else {
            $_SESSION['loginMessage'] = "Wrong password, try again.";
            header("location:login.php");
            exit();
        }
    } else {
        $_SESSION['loginMessage'] = "Username not found.";
        header("location:login.php");
        exit();
    }
}
?>
