<?php 
include 'partials/header.php'; 
include 'koneksi.php';

$row = null;

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tb_inventori WHERE nomor_inventaris = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
}
?>

<div class="main-content py-5">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detail Data Inventaris</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <?php if ($row): ?>
                    <div class="card mb-4 shadow-sm">
                        <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" 
                            alt="<?php echo htmlspecialchars($row['nama_barang']); ?>" style="height: 250px; object-fit: cover;">
                        
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3"><?php echo htmlspecialchars($row['nama_barang']); ?></h5>
                            
                            <p class="card-text mb-2"><strong>Nomor Inventaris:</strong> <?php echo htmlspecialchars($row['nomor_inventaris']); ?></p>
                            <p class="card-text mb-2"><strong>Kondisi:</strong> 
                                <span class="badge <?php echo ($row['kondisi_barang'] === 'Normal') ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo htmlspecialchars($row['kondisi_barang']); ?>
                                </span>
                            </p>
                            <p class="card-text mb-2"><strong>Divisi:</strong> <?php echo htmlspecialchars($row['divisi']); ?></p>
                            <p class="card-text mb-2"><strong>Tanggal Pembelian:</strong> <?php echo date('d-m-Y', strtotime($row['tgl_pembelian'])); ?></p>
                            <p class="card-text mb-3"><strong>Keterangan:</strong> <?php echo nl2br(htmlspecialchars($row['keterangan'])); ?></p>
                            
                            <a href="inventaris.php" class="btn btn-secondary w-100">Kembali</a>
                        </div>    
                    </div>
                
                <?php else: ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <h4 class="alert-heading">Data Tidak Ditemukan!</h4>
                        <p>Nomor inventaris tidak valid atau aset telah dihapus dari sistem.</p>
                        <hr>
                        <a href="inventaris.php" class="btn btn-danger btn-sm">Kembali ke Daftar Inventaris</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>