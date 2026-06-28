<?php
include 'partials/header.php';
include 'koneksi.php';

$row = null;

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $nomor_inventaris = $_GET['id'];
    
    $query_select = "SELECT * FROM tb_inventori WHERE nomor_inventaris = ?";
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    
    if ($stmt_select) {
        mysqli_stmt_bind_param($stmt_select, "s", $nomor_inventaris);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt_select);
    }
}

if (!$row) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='inventaris.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_inventaris = $_POST['nomor_inventaris'];
    $nama_barang      = trim($_POST['nama_barang']);
    $kondisi_barang   = $_POST['kondisi_barang'];
    $tgl_pembelian    = $_POST['tgl_pembelian'];
    $divisi           = $_POST['divisi'];
    $keterangan           = trim($_POST['keterangan']);

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "webp");

        if (in_array($ext, $allowed_extensions)) {
            $foto_baru = uniqid('INV-', true) . '.' . $ext;
            
            if (move_uploaded_file($tmp, 'uploads/' . $foto_baru)) {
                if (!empty($row['gambar']) && file_exists('uploads/' . $row['gambar'])) {
                    unlink('uploads/' . $row['gambar']);
                }

                $query_update = "UPDATE tb_inventori SET nama_barang=?, kondisi_barang=?, tgl_pembelian=?, divisi=?, keterangan=?, gambar=? WHERE nomor_inventaris=?";
                $stmt_update  = mysqli_prepare($koneksi, $query_update);
                
                if ($stmt_update) {
                    mysqli_stmt_bind_param($stmt_update, "sssssss", $nama_barang, $kondisi_barang, $tgl_pembelian, $divisi, $keterangan, $foto_baru, $nomor_inventaris);
                    $execute = mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
                }
            } else {
                echo "<script>alert('Gagal mengunggah gambar baru.');</script>";
                $execute = false;
            }
        } else {
            echo "<script>alert('Format file tidak didukung! Hanya diperbolehkan JPG, JPEG, PNG, dan WEBP.');</script>";
            $execute = false;
        }
    } else {
        $query_update = "UPDATE tb_inventori SET nama_barang=?, kondisi_barang=?, tgl_pembelian=?, divisi=?, keterangan=? WHERE nomor_inventaris=?";
        $stmt_update  = mysqli_prepare($koneksi, $query_update);
        
        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "ssssss", $nama_barang, $kondisi_barang, $tgl_pembelian, $divisi, $keterangan, $nomor_inventaris);
            $execute = mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        }
    }

    if (isset($execute) && $execute) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='inventaris.php';</script>";
    } elseif (isset($execute)) {
        echo "<script>alert('Gagal memperbarui data inventaris.');</script>";
    }
}
?>

<div class="main-content">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
                <header class="py-2 border-bottom mb-4">
                    <h1 class="h2">Ubah Data Inventori</h1>
                </header>
                
                <form action="" method="post" id="myForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nomor_inventaris" class="form-label">Nomor Inventaris</label>
                                <input type="text" name="nomor_inventaris" id="nomor_inventaris" value="<?php echo htmlspecialchars($row['nomor_inventaris']); ?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Kondisi Barang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisi_barang" id="kondisi_rusak" value="Rusak" <?php echo ($row['kondisi_barang'] === 'Rusak') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="kondisi_rusak">Rusak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisi_barang" id="kondisi_normal" value="Normal" <?php echo ($row['kondisi_barang'] === 'Normal') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="kondisi_normal">Normal</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                                <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control" value="<?php echo htmlspecialchars($row['tgl_pembelian']); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="divisi" class="form-label">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    <option value="HRD" <?php echo ($row['divisi'] === 'HRD') ? 'selected' : ''; ?>>Human Resources Development</option>
                                    <option value="IT Dept" <?php echo ($row['divisi'] === 'IT Dept') ? 'selected' : ''; ?>>IT Department</option>
                                    <option value="Finance Dept" <?php echo ($row['divisi'] === 'Finance Dept') ? 'selected' : ''; ?>>Finance Department</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Barang (Kosongkan jika tidak diganti)</label>
                                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                <div class="mt-3">
                                    <img id="preview" src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Preview Gambar" style="display: <?php echo (!empty($row['gambar'])) ? 'block' : 'none'; ?>; max-width: 150px;" class="img-thumbnail">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-3">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            <a href="inventaris.php" class="btn btn-secondary px-4">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('foto').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php include 'partials/footer.php'; ?>
