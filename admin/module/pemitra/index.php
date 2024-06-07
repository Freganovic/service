<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Lain</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    @media print {
        body * {
            visibility: hidden;
        }
        #example1,
        #example1 * {
            visibility: visible;
        }
        #example1 {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #DFF0D8;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    }
</style>

</head>

<body>
    <div class="container mt-5">
        <h1>PEMBAYARAN LAIN</h1>
        <!-- view barang -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan Tagihan</th>
                                <th style="width:10%;">Total</th>
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

                            // Query untuk mengambil data dari tabel "konter"
                            $query = "SELECT * FROM konter";
                            $result = $koneksi->query($query);

                            if ($result) {
                                $no = 1;
                                $total_total = 0;

                                // Mengambil data dari hasil query
                                while ($row = $result->fetch_assoc()) {
                                    $total_total += $row['total'];
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td>Rp.<?php echo number_format($row['total'], 2); ?>,-</td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            } else {
                                echo "Gagal mengambil data dari database.";
                            }

                            // Menutup koneksi database
                            $koneksi->close();
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th style="background:#0bb365;color:#fff;">Rp.<?= number_format($total_total, 2); ?>,-</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- Tombol Print dan Reset Data -->
        <button type="button" class="btn btn-info" id="btn-print">Print</button>
        <button type="button" class="btn btn-danger" id="btn-reset">Reset Semua Data</button>

        <!-- Tombol Tambah Data -->
        <button type="button" class="btn btn-primary" id="btn-tambah-data" data-toggle="modal" data-target="#tambahDataModal">
            Tambah Data
        </button>

        <!-- Modal untuk Tambah Data -->
        <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Konter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-konter">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Keterangan Tagihan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" id="total" name="total" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btn-simpan-konter">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Tangani pengiriman data konter saat tombol "Simpan" di modal ditekan
                $('#btn-simpan-konter').click(function() {
                    var dataKonter = {
                        tanggal: $('#tanggal').val(),
                        nama: $('#nama').val(),
                        total: $('#total').val()
                    };

                    // Kirim data konter menggunakan AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'alat/proses_tambah_konter.php',
                        data: dataKonter,
                        success: function(response) {
                            if (response === 'success') {
                                alert('Data berhasil disimpan');
                                $('#tambahDataModal').modal('hide'); // Tutup modal
                                location.reload(); // Mereset halaman
                            } else {
                                alert('Gagal menyimpan data: ' + response);
                            }
                        }
                    });
                });
                // Tombol print
                $('#btn-print').click(function() {
                    // Mengatur tampilan cetakan
                    var originalContents = document.body.innerHTML;
                    var printContents = document.getElementById('example1').outerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                });
                // Tombol reset semua data
                $('#btn-reset').click(function() {
                    if (confirm('Apakah Anda yakin ingin mereset semua data?')) {
                        $.ajax({
                            type: 'POST',
                            url: 'alat/proses_reset_pemitra.php',
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    alert('Semua data berhasil direset');
                                    location.reload();
                                } else {
                                    alert('Gagal mereset data: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Terjadi kesalahan saat mengirim permintaan: ' + error);
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</body>

</html>