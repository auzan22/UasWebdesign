<?php include 'a/header.php'; ?>

<div style="display: flex; max-width:1200px; margin:2rem auto;">
  <?php
    // Koneksi database 1
    if (file_exists('file/koneksi.php')) {
      include 'file/koneksi.php'; // $conn
    } else {
      echo "File koneksi.php tidak ditemukan!";
      exit;
    }

    // Koneksi database 2
    if (file_exists('file/koneksi1.php')) {
      include 'file/koneksi1.php'; // $conn2
    } else {
      echo "File koneksi1.php tidak ditemukan!";
      exit;
    }

    if (isset($_GET['kategori'])) {
      include 'file/kategori.php';
    } elseif (isset($_GET['a'])) {
      include 'file/coba.php';
    } elseif (isset($_GET['search'])) {
      include 'file/search.php';
    } else {
      include 'file/home.php';
    }
  ?>
</div>

<?php include 'a/footer.php'; ?>
