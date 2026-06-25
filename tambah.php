<?php
include 'partials/header.php';
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_inventaris = trim($_POST['nomor_inventaris']);
    $nama_barang      = trim($_POST['nama_barang']);
    $kondisi_barang   = $_POST['kondisi_barang'];
    $tgl_pembelian    = $_POST['tgl_pembelian'];
    $divisi           = $_POST['divisi'];
    $keterangan           = trim($_POST['keterangan']);

    $foto       = $_FILES['file']['name'];
    $tmp        = $_FILES['file']['tmp_name'];
    $target_dir = "uploads/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "webp");

    if (in_array($ext, $allowed_extensions)) {
        $fotoname    = uniqid('INV-', true) . '.' . $ext;
        $target_file = $target_dir . $fotoname;

        if (move_uploaded_file($tmp, $target_file)) {
            
            $query = "INSERT INTO tb_inventori (nomor_inventaris, nama_barang, kondisi_barang, tgl_pembelian, divisi, keterangan, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt  = mysqli_prepare($koneksi, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssss", $nomor_inventaris, $nama_barang, $kondisi_barang, $tgl_pembelian, $divisi, $keterangan, $fotoname);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Data berhasil disimpan'); window.location.href='inventaris.php';</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan data ke database.');</script>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Gagal menyiapkan sistem database.');</script>";
            }

        } else {
            echo "<script>alert('Error: Gagal mengunggah gambar');</script>";
        }
    } else {
        echo "<script>alert('Format file tidak didukung! Hanya diperbolehkan JPG, JPEG, PNG, dan WEBP.');</script>";
    }
}
?>

<div class="main-content">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
                <header class="py-2 border-bottom mb-4">
                    <h1 class="h2">Tambah Inventaris</h1>
                </header>
                
                <form action="" method="post" id="myForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nomor_inventaris" class="form-label">Nomor Inventaris</label>
                                <input type="text" name="nomor_inventaris" id="nomor_inventaris" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Kondisi Barang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisi_barang" id="kondisi_rusak" value="Rusak" required>
                                    <label class="form-check-label" for="kondisi_rusak">Rusak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisi_barang" id="kondisi_normal" value="Normal" required>
                                    <label class="form-check-label" for="kondisi_normal">Normal</label>
                                </div> </div>
                            <div class="mb-3">
                                <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                                <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="divisi" class="form-label">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    <option value="HRD">Human Resources Development</option>
                                    <option value="IT Dept">IT Department</option>
                                    <option value="Finance Dept">Finance Department</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="Keterangan" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Foto Barang</label>
                                <input type="file" name="file" id="file" class="form-control" accept="image/*" required>
                                <div class="mt-3">
                                    <img id="preview" src="#" alt="Preview Gambar" class="img-thumbnail" style="display: none; max-width: 150px; height: auto;">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-3">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <a href="inventaris.php" class="btn btn-secondary px-4">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('file').addEventListener('change', function(event) {
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