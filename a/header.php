<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Berita</title>

  <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.0/dist/js/coreui.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.0/dist/css/coreui.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
    }

    /* HEADER */
    .header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999;
      background: linear-gradient(90deg,rgb(0, 0, 0), #ffffff);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 30px;
      box-shadow: 0 2px 5px rgba(65, 65, 65, 0.5);
    }

    .logo {
      display: flex;
      align-items: center;
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    .logo-img {
      width: 40px;
      height: 40px;
      margin-right: 10px;
      object-fit: contain;
    }

    .search-box form {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .search-box input {
      padding: 10px 16px;
      border-radius: 20px;
      border: none;
      outline: none;
      width: 220px;
    }

    .search-box button {
      background:rgb(117, 113, 111);
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 16px;
    }

    .navbar {
      position: fixed;
      top: 60px; /* setelah header */
      width: 100%;
      background: linear-gradient(90deg, #000000, #ffffff);
      display: flex;
      justify-content: center;
      padding: 10px 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
      z-index: 998;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      margin: 0 15px;
      white-space: nowrap;
    }

    .navbar a:hover {
      color: #ff6600;
    }

    .breaking-news {
      background: #ff6600;
      color: white;
      padding: 10px 30px;
      margin-top: 120px; /* 60 header + 60 navbar */
      white-space: nowrap;
      overflow: hidden;
      position: relative;
    }

    .breaking-news span {
      display: inline-block;
      padding-left: 100%;
      animation: scrollText 40s linear infinite;
    }

    @keyframes scrollText {
      0% { transform: translateX(0%); }
      100% { transform: translateX(-100%); }
    }

    .content {
      margin-top: 170px; /* cukup setelah breaking-news */
      padding: 20px;
    }
  </style>
</head>
<body>

  <div class="header">
    <div class="logo">
      <img src="image/a.png" alt="Logo" class="logo-img">
      <span>MORPHY NEWS</span>
    </div>
    <div class="search-box">
      <form action="index.php" method="get">
        <input type="text" name="search" placeholder="Cari berita...">
        <button type="submit">🔍</button>
      </form>
    </div>
  </div>

  <div class="navbar">
    <a href="index.php">HOME</a>
    <a href="index.php?kategori=OLAHRAGA">OLAHRAGA</a>
    <a href="index.php?kategori=EKONOMI">EKONOMI</a>
    <a href="index.php?kategori=SOSIAL">SOSIAL</a>
    <a href="index.php?kategori=PENDIDIKAN">PENDIDIKAN</a>
    <a href="index.php?kategori=LINGKUNGAN">LINGKUNGAN</a>
  </div>

  <div class="breaking-news">
    <span>
      HEADLINE HARI INI: Akan Gelar Piala Dunia Bola Basket Junior, Perbasi Jalin Kerjasama dengan LPDUK Kemenpora • 
      Ekonomi Global Meningkat, Indonesia Alami Pertumbuhan 5.2% • 
      BMKG Ungkap Kondisi El Nino dan La Nina Saat Musim Kemarau 2024 • 
      UI Masuk Daftar 200 Universitas Terbaik Dunia Tahun 2025 • 
      Pontianak Berlakukan Jam Malam bagi Warga di Bawah 18 Tahun • 
      Info Terbaru Hari Ini • Update Terus Setiap Jam
    </span>
  </div>

</body>
</html>
