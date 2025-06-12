<?php
$host = 'localhost';
$user = 'root';     
$pass = '';       
$db   = 'berita';

$conn = mysqli_connect("localhost", "root", "", "berita");
if (!$conn) {
  die("Koneksi database berita gagal: " . mysqli_connect_error());
}
?>
