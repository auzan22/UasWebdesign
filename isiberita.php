<?php
include 'a/header.php';
include 'file/koneksi1.php';
?>

<style>
    .content {
        margin-top: 120px; 
        padding: 20px;
    }

    .news-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 900px;
        margin: auto;
        overflow: hidden;
    }

    .judul-berita {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .card-image {
        width: 100%;
        height: 250px;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-radius: 10px 10px 0 0;
    }

    .card-image img {
        height: 100%;
        width: auto;
        object-fit: cover;
    }

    .news-content {
        padding: 20px;
    }

    .meta {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
        text-align: center;
    }

    .isi {
        text-align: justify;
        line-height: 1.7;
    }

    a.kembali {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
    }

    a.kembali:hover {
        text-decoration: underline;
    }
</style>

<div class="content">
<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM berita WHERE id = $id"; // nama tabel: berita
    $result = mysqli_query($conn2, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="judul-berita">
            <?php echo htmlspecialchars($row['judul']); ?>
        </div>

        <div class="news-card">
            <div class="card-image">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Berita">
            </div>

            <div class="news-content">
                <div class="meta">
                    <strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?> |
                    <strong>Tanggal:</strong> <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                </div>
                <div class="isi">
                    <?php echo nl2br(htmlspecialchars($row['isi'])); ?>
                </div>
                <a class="kembali" href="index.php">← Kembali ke Beranda</a>
            </div>
        </div>

        <?php
    } else {
        echo "<p style='text-align:center;'>Berita tidak ditemukan.</p>";
    }
} else {
    echo "<p style='text-align:center;'>ID berita tidak diberikan.</p>";
}
?>
</div>

<?php include 'a/footer.php'; ?>
