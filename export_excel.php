<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$conn = mysqli_connect($host, $user, $password, $db, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=users_data.xls");

echo "Username\tEmail\tPhone\n";

$query = "SELECT username, email, phone FROM user";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['username'] . "\t" . $row['email'] . "\t" . $row['phone'] . "\n";
}
?>
