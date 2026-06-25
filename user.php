<?php include 'partials/header.php'; ?>

<div class="main-content">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
   
                <header class="d-flex justify-content-between align-items-center py-2 mb-3 border-bottom">
                    <h1 class="h2 mb-0">Data User</h1>
                    <div>
                        <button id="btnTambah" class="btn btn-primary">
                            <i class="fa-solid fa-user-plus me-1"></i> Tambah User
                        </button>
                    </div>
                </header>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="tabel_user">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 8%;">No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            </tbody>
                    </table>             
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="userModalLabel">Modal title</h5>
                    <button type="button" class="btn p-0 border-0" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem;">
                        <i class="fa-solid fa-xmark text-secondary"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Save</button>
                    <button type="submit" class="btn btn-success text-white" id="btnUpdate">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var tabelUser = $('#tabel_user').DataTable({
        "responsive": true
    });

    tampilData();

    function tampilData() {
        $.ajax({
            url: "user/read.php",
            method: "GET",
            success: function(data) {
                if ($.fn.DataTable.isDataTable('#tabel_user')) {
                    tabelUser.destroy();
                }
                
                $('#tabel_user tbody').html(data);
                
                tabelUser = $('#tabel_user').DataTable({
                    "responsive": true
                });
            },
            error: function() {
                toastr.error('Gagal mengambil data dari server.');
            }
        });
    }

    $('#btnTambah').click(function() {
        $('#userModalLabel').text('Tambah User');
        $('#userForm')[0].reset();
        $('#user_id').val('');
        $('#btnSimpan').show();
        $('#btnUpdate').hide();
        $('#userModal').modal('show');
    });

    $('#userForm').submit(function(e) {
        e.preventDefault(); 
        
        var formData = $(this).serialize();
        var targetUrl = $('#btnSimpan').is(':visible') ? "user/create.php" : "user/update.php";
        
        $.ajax({
            url: targetUrl,
            method: "POST",
            data: formData,
            success: function(response) {
                $('#userModal').modal('hide');
                tampilData();
                toastr.success('Data berhasil diproses');
            },
            error: function() {
                toastr.error('Data gagal diproses ke server');
            }
        });
    });

    $(document).on('click', '#btnEdit', function() {
        var user_id = $(this).data('id');
        $.ajax({
            url: "user/get.php",
            method: "GET",
            data: { user_id: user_id },
            success: function(data) {
                try {
                    var user = JSON.parse(data);
                    $('#user_id').val(user.user_id);
                    $('#username').val(user.username);
                    $('#password').val(user.password);
                    
                    $('#userModalLabel').text('Edit User');
                    $('#btnSimpan').hide();
                    $('#btnUpdate').show();
                    $('#userModal').modal('show');
                } catch(e) {
                    toastr.error('Gagal memproses data format server.');
                }
            },
            error: function() {
                toastr.error('Gagal mengambil detail user.');
            }
        });
    });

    $(document).on('click', '#btnHapus', function() {
        var user_id = $(this).data('id');
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            $.ajax({
                url: "user/delete.php",
                method: "POST",
                data: { user_id: user_id },
                success: function(data) {
                    tampilData();
                    toastr.success('Data berhasil dihapus');
                },
                error: function() {
                    toastr.error('Data gagal dihapus');
                }
            });
        }
    });

    $(document).on('click', '[data-bs-dismiss="modal"]', function() {
        $('#userModal').modal('hide');
    });
});
</script>

<?php include 'partials/footer.php'; ?>