<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Berita Kategori</title>
  <link rel="stylesheet" href="file/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f2f2f2;
    }
    .konten {
      max-width: 900px;
      margin: 30px auto;
      padding: 10px;
    }
    .news-card {
      background: white;
      margin-bottom: 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1), 0 0 30px rgba(255,255,255,0.2);
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }
    .news-image {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
    }
    .news-text {
      padding: 20px;
    }
    .news-category {
      background: #444;
      color: white;
      padding: 4px 10px;
      font-size: 14px;
      border-radius: 4px;
    }
    .news-title {
      margin: 10px 0 10px;
      color: #222;
    }
    .news-desc {
      color: #555;
    }
    .news-date {
      font-size: 14px;
      color: #888;
      margin-top: 10px;
    }
    .pagination {
      text-align: center;
      margin: 30px 0;
    }
    .pagination a {
      display: inline-block;
      padding: 8px 12px;
      margin: 0 5px;
      background: #ddd;
      text-decoration: none;
      color: black;
      border-radius: 5px;
    }
    .pagination a.active {
      background: #222;
      color: white;
    }
    .read-more {
      display: inline-block;
      margin-top: 10px;
      color: blue;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>
<main class="konten">
<?php
include 'koneksi.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($conn, $_GET['kategori']) : '';

$query = "SELECT * FROM berita WHERE kategori='$kategori' ORDER BY tanggal DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $judul = htmlspecialchars($row['judul']);
  $isi = htmlspecialchars($row['isi']);
  $gambar = htmlspecialchars($row['gambar']);
  $tanggal = date('j F Y', strtotime($row['tanggal']));
  $kategori = htmlspecialchars($row['kategori']);
  $excerpt = mb_strimwidth(strip_tags($isi), 0, 200, '...');
  echo "<div class='news-card'>";
  echo "  <img class='news-image' src='$gambar' alt='Gambar Berita'>";
  echo "  <div class='news-text'>";
  echo "    <span class='news-category'>$kategori</span>";
  echo "    <h2 class='news-title'>$judul</h2>";
  echo "    <p class='news-desc'>$excerpt</p>";
  echo "    <a class='read-more' href='?kategori=" . urlencode($kategori) . "&berita=$id&page=$page'>Baca Selengkapnya</a>";
  echo "    <p class='news-date'>$tanggal</p>";
  echo "  </div>";
  echo "</div>";
}

// PAGINATION
$count = mysqli_query($conn, "SELECT COUNT(*) as total FROM berita WHERE kategori='$kategori'");
$total = mysqli_fetch_assoc($count)['total'];
$total_pages = ceil($total / $limit);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
  $active = $i == $page ? "class='active'" : '';
  echo "<a href='?kategori=" . urlencode($kategori) . "&page=$i' $active>$i</a>";
}
echo "</div>";
?>
</main>
</body>
</html>
