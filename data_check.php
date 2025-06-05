<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 4306;

$data = mysqli_connect($host, $user, $password, $db, $port);

if ($data === false) {
    die("Connection error");
}
if (isset($_POST['apply']))

{
    $data_name=$_POST['name'];
     $data_email=$_POST['email'];
      $data_phone=$_POST['phone'];
       $data_message=$_POST['message'];

       $sql="INSERT INTO admission(name,email,phone,message)
       VALUES('$data_name','$data_email','$data_phone','$data_message')";
$result=mysqli_query($data,$sql);
if($result){
    echo '<center><h1>Apply success</h1></center>';
}
else{
    echo '<center><h1>Apply failed</h1></center>';
}



}


?>