<?php 
include 'partials/header.php'; 
include 'koneksi.php'; 

$query = "SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN kondisi_barang = 'Normal' THEN 1 ELSE 0 END) as normal,
            SUM(CASE WHEN kondisi_barang = 'Rusak' THEN 1 ELSE 0 END) as rusak
          FROM tb_inventori";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$total_barang = $data['total'] ?? 0;
$total_normal = $data['normal'] ?? 0;
$total_rusak  = $data['rusak'] ?? 0;
?>

<div class="main-content">
    <div class="container-fluid mt-4">
        
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 mb-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #FFFDD0 0%, #F5F5DC 100%); border: 1px solid #E6E2AF;">
                    <div class="container-fluid py-2 text-center">
                        <h1 class="display-5 fw-bold text-dark">Data Inventaris Kantor</h1>
                        <p class="fs-4 text-secondary mt-3">Selamat datang di Database Inventaris Kantor SURFACE!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 bg-light">
                    <div class="card-body d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-primary text-white me-3">
                            <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Barang</h6>
                            <h3 class="fw-bold mb-0"><?php echo $total_barang; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 bg-light">
                    <div class="card-body d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-success text-white me-3">
                            <i class="fa-solid fa-circle-check fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Kondisi Normal</h6>
                            <h3 class="fw-bold mb-0 text-success"><?php echo $total_normal; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 bg-light">
                    <div class="card-body d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-danger text-white me-3">
                            <i class="fa-solid fa-circle-exclamation fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="card-title text-muted mb-1">Kondisi Rusak</h6>
                            <h3 class="fw-bold mb-0 text-danger"><?php echo $total_rusak; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> 
    </div>
</div>

<?php include 'partials/footer.php'; ?>