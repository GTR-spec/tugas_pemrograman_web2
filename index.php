<?php 
include 'partials/header.php';
include 'koneksi.php';

$query = "SELECT * FROM tb_inventori";
$result = mysqli_query($koneksi, $query);
?>

<div class="main-content py-5">
    <div class="container mt-5">
        <h2 class="mb-4">Data Inventaris</h2>
        <div class="row">
            <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { 
                    $nama_barang = htmlspecialchars($row['nama_barang']);
                    $no_inventaris = htmlspecialchars($row['nomor_inventaris']);
                    $divisi = htmlspecialchars($row['divisi']);
                    $gambar = htmlspecialchars($row['gambar']);
            ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="uploads/<?php echo $gambar; ?>" class="card-img-top" 
                         alt="<?php echo $no_inventaris; ?>" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nama_barang; ?></h5>
                        <p class="card-text mb-1"><strong>Nomor Inventaris:</strong> <?php echo $no_inventaris; ?></p>
                        <p class="card-text mb-3"><strong>Divisi:</strong> <?php echo $divisi; ?></p>
                        <a href="detail.php?id=<?php echo urlencode($no_inventaris); ?>" class="btn btn-primary w-100">Detail</a>
                    </div>    
                </div>
            </div>
            <?php 
                } 
            } else { 
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data inventaris yang tersedia.</p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>