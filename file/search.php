<?php
if (!isset($conn)) {
  echo "Koneksi tidak tersedia.";
  exit;
}

$search = mysqli_real_escape_string($conn, $_GET['search']);
$query = "SELECT * FROM berita WHERE judul LIKE '%$search%' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='news-card' style='
      box-shadow: 0 0 10px rgba(0,0,0,0.2), 0 0 10px rgba(255,255,255,0.1); 
      margin-bottom: 1.5rem;
      border-radius: 12px;
      display: flex;
      overflow: hidden;
      background: white;
    '>";
    
    echo "  <div class='news-text' style='padding: 1rem; flex:1'>";
    echo "    <span class='news-category' style='font-size: 0.9rem; color: #888;'>" . htmlspecialchars($row['kategori']) . "</span>";
    echo "    <h2 class='news-title' style='margin: 0.5rem 0;'><a href='?a=" . $row['id'] . "' style='color: black; text-decoration: none;'>" . htmlspecialchars($row['judul']) . "</a></h2>";
    echo "    <p class='news-desc' style='color: #444;'>" . mb_strimwidth(strip_tags($row['isi']), 0, 200, '...') . "</p>";
    echo "    <p class='news-date' style='font-size: 0.8rem; color: #aaa;'>" . date('j F Y', strtotime($row['tanggal'])) . "</p>";
    echo "  </div>";
    
    echo "  <img class='news-image' src='" . htmlspecialchars($row['gambar']) . "' alt='Gambar Berita' style='width: 200px; object-fit: cover;'>";
    
    echo "</div>";
  }
} else {
  echo "<p>Tidak ada berita yang cocok dengan pencarian Anda.</p>";
}
?>
