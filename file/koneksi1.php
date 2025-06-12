<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'isiberita'; 

$conn2 = mysqli_connect("localhost", "root", "", "isiberita");
if (!$conn2) {
  die("Koneksi database isiberita gagal: " . mysqli_connect_error());
}
?>