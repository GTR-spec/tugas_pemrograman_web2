<?php 
include 'partials/header.php'; 
include 'koneksi.php';

$query = "SELECT * FROM tb_inventori";
$result = mysqli_query($koneksi, $query);
?>

<div class="main-content">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
   
                <header class="d-flex justify-content-between align-items-center py-3 mb-3 border-bottom">
                    <h1 class="h2 mb-0">Data Inventaris Kantor</h1>
                    <div>
                        <a href="tambah.php" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah
                        </a>
                        <a href="report.php" class="btn btn-danger" target="_blank">
                            <i class="fa-solid fa-file-pdf me-1"></i> Cetak PDF
                        </a>
                    </div>
                </header>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="tabel_inventoris">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 15%;">Gambar</th>
                                <th>Nomor Inventaris</th>
                                <th>Nama Barang</th>
                                <th>Kondisi Barang</th>
                                <th>Tanggal Pembelian</th>
                                <th>Divisi</th>
                                <th>Keterangan</th>
                                <th style="width: 12%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Proteksi XSS dengan htmlspecialchars
                                $id_encode   = urlencode($row['nomor_inventaris']);
                                $no_inv      = htmlspecialchars($row['nomor_inventaris']);
                                $nama_barang = htmlspecialchars($row['nama_barang']);
                                $kondisi     = htmlspecialchars($row['kondisi_barang']);
                                $tgl_beli    = htmlspecialchars($row['tgl_pembelian']);
                                $divisi      = htmlspecialchars($row['divisi']);
                                $keterangan      = htmlspecialchars($row['keterangan']);
                                $gambar      = htmlspecialchars($row['gambar']);
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <img src="uploads/<?php echo $gambar; ?>" alt="<?php echo $nama_barang; ?>" class="img-thumbnail" style="max-width: 80px; height: auto;">
                                    </td>
                                    <td><?php echo $no_inv; ?></td>
                                    <td><?php echo $nama_barang; ?></td>
                                    <td>
                                        <span class="badge <?php echo ($kondisi == 'Normal') ? 'bg-success' : 'bg-danger'; ?>">
                                            <?php echo $kondisi; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $tgl_beli; ?></td>
                                    <td><?php echo $divisi; ?></td>
                                    <td><?php echo $keterangan; ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="edit.php?id=<?php echo $id_encode; ?>" class="btn btn-sm btn-warning">Edit</a> 
                                            <a href="hapus.php?id=<?php echo $id_encode; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                            } 
                            ?>
                        </tbody>
                    </table>        
                </div>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables (Pastikan library JS DataTables sudah di-include di footer/header)
    if ($.fn.DataTable) {
        $('#tabel_inventoris').DataTable({
            "responsive": true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json" // Opsional: Mengubah bahasa DataTables ke Indonesia
            }
        });
    }
});
</script>

<?php include 'partials/footer.php'; ?>