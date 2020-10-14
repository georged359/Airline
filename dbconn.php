<?php
$servername = "localhost";
$user = "root";
$pword = "root";
$dbname = "Myflyone";
$conn = new mysqli($servername,$user,$pword,$dbname);

if($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
}
echo "Connected successfully";
?>
