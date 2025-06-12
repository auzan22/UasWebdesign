<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Portal Berita</title>
  <link rel="stylesheet" href="file/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f2f2f2;
    }

    .container {
      display: flex;
      max-width: 1200px;
      margin: 30px auto;
      padding: 0 10px;
      gap: 20px;
    }

    .sidebar-kiri, .sidebar-kanan {
      width: 20%;
    }

    .konten {
      width: 60%;
    }

    /* Sidebar Kategori */
    .sidebar-kategori {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .sidebar-kategori h3 {
      font-size: 18px;
      margin-bottom: 15px;
      color: #ff6600;
      border-bottom: 2px solid #ff6600;
      padding-bottom: 5px;
    }

    .sidebar-kategori ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-kategori ul li {
      margin-bottom: 10px;
    }

    .sidebar-kategori ul li a {
      text-decoration: none;
      color: #000;
      font-weight: 500;
    }

    .sidebar-kategori ul li a:hover {
      color: #ff6600;
    }

    /* Sidebar Topik Populer */
    .box {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .box--header__title {
      font-size: 18px;
      color: #0066cc;
      border-bottom: 2px solid #0066cc;
      padding-bottom: 5px;
      margin-bottom: 15px;
    }

    .aside-list {
      list-style: none;
      padding: 0;
    }

    .tag-snippet {
      margin-bottom: 10px;
    }

    .tag-snippet__link {
      text-decoration: none;
      color: #000;
    }

    .tag-snippet__link:hover {
      color: #0066cc;
    }

    .tag-snippet__hash-tag {
      color: #999;
      margin-right: 5px;
    }

    /* Konten Berita */
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

<div class="container">

  <!-- Sidebar Kiri: Kategori -->
  <aside class="sidebar-kiri">
    <div class="sidebar-kategori">
      <h3>KATEGORI</h3>
      <ul>
        <li><a href="index.php?kategori=OLAHRAGA">Olahraga</a></li>
        <li><a href="index.php?kategori=EKONOMI">Ekonomi</a></li>
        <li><a href="index.php?kategori=SOSIAL">Sosial</a></li>
        <li><a href="index.php?kategori=PENDIDIKAN">Pendidikan</a></li>
        <li><a href="index.php?kategori=LINGKUNGAN">Lingkungan</a></li>
      </ul>
    </div>
  </aside>

  <!-- Konten Berita Utama -->
  <main class="konten">
  <?php
    include 'file/koneksi.php';

    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1);
    $start = ($page - 1) * $limit;

    $query = "SELECT * FROM berita WHERE 1";
    if (!empty($_GET['kategori'])) {
      $kategori = $_GET['kategori'];
      $query .= " AND kategori='" . mysqli_real_escape_string($conn, $kategori) . "'";
    }
    if (!empty($_GET['search'])) {
      $search = $_GET['search'];
      $query .= " AND judul LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
    }
    $query .= " ORDER BY tanggal DESC LIMIT $start, $limit";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      echo "<div class='news-card'>";
      echo "  <img class='news-image' src='" . htmlspecialchars($row['gambar']) . "' alt='Gambar Berita'>";
      echo "  <div class='news-text'>";
      echo "    <span class='news-category'>" . htmlspecialchars($row['kategori']) . "</span>";
      echo "    <h2 class='news-title'>" . htmlspecialchars($row['judul']) . "</h2>";
      echo "    <p class='news-desc'>" . mb_strimwidth(strip_tags($row['isi']), 0, 200, '...') . "</p>";

      $link = "isiberita.php?id=" . $row['id'];
      if (!empty($_GET['kategori'])) $link .= "&kategori=" . urlencode($_GET['kategori']);
      if (!empty($_GET['search'])) $link .= "&search=" . urlencode($_GET['search']);
      echo "<a class='read-more' href='$link'>Baca Selengkapnya</a>";

      echo "    <p class='news-date'>" . date('j F Y', strtotime($row['tanggal'])) . "</p>";
      echo "  </div>";
      echo "</div>";
    }

    $countQuery = "SELECT COUNT(*) as total FROM berita WHERE 1";
    if (!empty($_GET['kategori'])) {
      $countQuery .= " AND kategori='" . mysqli_real_escape_string($conn, $_GET['kategori']) . "'";
    }
    if (!empty($_GET['search'])) {
      $countQuery .= " AND judul LIKE '%" . mysqli_real_escape_string($conn, $_GET['search']) . "%'";
    }
    $countResult = mysqli_query($conn, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $total = $countRow['total'];
    $pages = ceil($total / $limit);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $pages; $i++) {
      echo "<a href='?page=$i";
      if (!empty($_GET['kategori'])) echo "&kategori=" . urlencode($_GET['kategori']);
      if (!empty($_GET['search'])) echo "&search=" . urlencode($_GET['search']);
      echo "'" . ($i == $page ? " class='active'" : "") . ">$i</a> ";
    }
    echo "</div>";
  ?>
  </main>

  <!-- Sidebar Kanan: Topik Populer -->
  <aside class="sidebar-kanan">
    <section id="phenomenon-tags" class="box">
      <header class="box--header">
        <h2 class="box--header__title"><a class="box--header__title-link normal-font-size" href="#">TOPIK POPULER</a></h2>
      </header>
      <ul class="aside-list asides--trending-tags">
        <li class="tag-snippet"><span class="tag-snippet__hash-tag">#</span><a href="http://localhost/webD1/isiberita.php?id=1" class="tag-snippet__link"><span class="tag-snippet__text">Akan Gelar Piala Dunia Bola Basket Junior, Perbasi Jalin Kerjasama dengan LPDUK Kemenpora</span></a></li>
        <li class="tag-snippet"><span class="tag-snippet__hash-tag">#</span><a href="http://localhost/webD1/isiberita.php?id=2" class="tag-snippet__link"><span class="tag-snippet__text">Nabella Chance Siap Tempur Hadapi Asia Pacific Padel Tour 2025 di Bali</span></a></li>
        <li class="tag-snippet"><span class="tag-snippet__hash-tag">#</span><a href="http://localhost/webD1/isiberita.php?id=3" class="tag-snippet__link"><span class="tag-snippet__text">Manfaat Jogging untuk Kesehatan Tubuh yang Luar Biasa, Jarang Diketahui</span></a></li>
        <li class="tag-snippet"><span class="tag-snippet__hash-tag">#</span><a href="http://localhost/webD1/isiberita.php?id=4" class="tag-snippet__link"><span class="tag-snippet__text">Harga Minyak Hari Ini 11 Juni 2025 Tembus Level Segini</span></a></li>
      </ul>
    </section>
  </aside>

</div>

</body>
</html>
