<?php
require_once __DIR__ . '/vendor/autoload.php';

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$conn = mysqli_connect($host, $user, $password, $db, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query
$query = "SELECT username, email, phone FROM user";
$result = mysqli_query($conn, $query);

// Create HTML for PDF
$html = '<h2>User Information</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
    <th>Username</th>
    <th>Email</th>
    <th>Phone</th>
</tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>
        <td>{$row['username']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone']}</td>
    </tr>";
}
$html .= '</table>';

// Generate PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('users_data.pdf', 'D'); // 'D' = force download
?>
