<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data hutang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Servisan yang belum di bayar</h1>
        <!-- view mitra -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr style="background-color:aquamarine">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Konfigurasi koneksi database
                            $host = "localhost"; // Ganti dengan host database Anda
                            $username = "root"; // Ganti dengan username database Anda
                            $password = ""; // Ganti dengan kata sandi database Anda
                            $database = "db_toko"; // Ganti dengan nama database Anda

                            // Membuat koneksi ke database
                            $koneksi = new mysqli($host, $username, $password, $database);

                            // Memeriksa koneksi
                            if ($koneksi->connect_error) {
                                die("Koneksi database gagal: " . $koneksi->connect_error);
                            }

                            // Query untuk mengambil data dari tabel "mitra"
                            $query = "SELECT * FROM mitra"; // Query SQL di sini
                            $result = $koneksi->query($query);

                            if ($result) {
                                $no = 1;

                                // Mengambil data dari hasil query
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cup_jumbo']); ?></td>
                                        <td>Rp.<?php echo number_format($row['nominal'], 2); ?>,-</td>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-edit" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#editDataModal">Edit</button>
                                            <button class="btn btn-danger btn-delete" data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='7'>Gagal mengambil data dari database.</td></tr>";
                            }

                            // Menutup koneksi database
                            $koneksi->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Data -->
        <button type="button" class="btn btn-primary" id="btn-tambah-data" data-toggle="modal" data-target="#tambahDataModal">
            Tambah Data
        </button>

        <!-- Modal untuk Tambah Data -->
        <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-mitra">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="cup_jumbo">Keterangan</label>
                                <input type="text" class="form-control" id="cup_jumbo" name="cup_jumbo" required>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" id="nominal" name="nominal" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Belum">Belum</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btn-simpan-mitra">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Edit Data -->
        <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit-mitra">
                            <input type="hidden" id="edit-id" name="id">
                            <div class="form-group">
                                <label for="edit-tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="edit-tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-nama">Nama</label>
                                <input type="text" class="form-control" id="edit-nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-cup_jumbo">Keterangan</label>
                                <input type="text" class="form-control" id="edit-cup_jumbo" name="cup_jumbo" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-nominal">Nominal</label>
                                <input type="number" class="form-control" id="edit-nominal" name="nominal" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-status">Status</label>
                                <select class="form-control" id="edit-status" name="status" required>
                                    <option value="Belum">Belum</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btn-update-mitra">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Tangani pengiriman data mitra saat tombol "Simpan" di modal ditekan
            $('#btn-simpan-mitra').click(function() {
                var dataMitra = {
                    tanggal: $('#tanggal').val(),
                    nama: $('#nama').val(),
                    cup_jumbo: $('#cup_jumbo').val(),
                    nominal: $('#nominal').val(),
                    status: $('#status').val()
                };

                // Kirim data mitra menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: 'alat/proses_tambah_mitra.php',
                    data: dataMitra,
                    success: function(response) {
                        if (response === 'success') {
                            alert('Data berhasil disimpan');
                            $('#tambahDataModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal menyimpan data: ' + response);
                        }
                    }
                });
            });

            // Tangani klik tombol Edit
            $('.btn-edit').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: 'fungsi/tambah/get_mitra.php',
                    data: { id: id },
                    dataType: 'json',
                    success: function(data) {
                        $('#edit-id').val(data.id);
                        $('#edit-tanggal').val(data.tanggal);
                        $('#edit-nama').val(data.nama);
                        $('#edit-cup_jumbo').val(data.cup_jumbo);
                        $('#edit-nominal').val(data.nominal);
                        $('#edit-status').val(data.status);
                        $('#editDataModal').modal('show');
                    }
                });
            });

            // Tangani pengiriman data edit mitra saat tombol "Update" di modal ditekan
            $('#btn-update-mitra').click(function() {
                var dataMitra = {
                    id: $('#edit-id').val(),
                    tanggal: $('#edit-tanggal').val(),
                    nama: $('#edit-nama').val(),
                    cup_jumbo: $('#edit-cup_jumbo').val(),
                    nominal: $('#edit-nominal').val(),
                    status: $('#edit-status').val()
                };

                // Kirim data mitra menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: 'fungsi/edit/proses_edit_mitra.php',
                    data: dataMitra,
                    success: function(response) {
                        if (response === 'success') {
                            alert('Data mitra berhasil diupdate');
                            $('#editDataModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal mengupdate data mitra: ' + response);
                        }
                    }
                });
            });
            $('.btn-delete').click(function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete data with ID ' + id + '?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'fungsi/hapus/proses_hapus_mitra.php',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'success') {
                                alert('Data mitra berhasil dihapus');
                                location.reload();
                            } else {
                                alert('Gagal menghapus data mitra: ' + response);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error deleting data: ' + error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
