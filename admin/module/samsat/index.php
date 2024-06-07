<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembukuan</title>
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

            th,
            td {
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
        <h1>PEMBUKUAN</h1>
        <!-- view barang -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Kerusakan</th>
                                <th>Toko Sparepath</th>
                                <th style="width:10%;">Harga User</th>
                                <th style="width:10%;">Modal</th>
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

                            // Query untuk mengambil data dari tabel "samsat"
                            $query = "SELECT * FROM samsat";
                            $result = $koneksi->query($query);

                            if ($result) {
                                $no = 1;
                                $total_pemasukan = 0;
                                $total_pengeluaran = 0;
                                $total_total = 0;

                                // Mengambil data dari hasil query
                                while ($row = $result->fetch_assoc()) {
                                    $total_pemasukan += $row['pemasukan'];
                                    $total_pengeluaran += $row['pengeluaran'];
                                    $total_total += $row['total'];
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['kerusakan']; ?></td>
                                        <td><?php echo $row['toko']; ?></td>
                                        <td>Rp.<?php echo number_format($row['pemasukan'], 2); ?>,-</td>
                                        <td>Rp.<?php echo number_format($row['pengeluaran'], 2); ?>,-</td>
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
                                <th colspan="5">Total</th>
                                <th style="background:#0bb365;color:#fff;">Rp.<?= number_format($total_pemasukan, 2); ?>,-</th>
                                <th style="background:#0bb365;color:#fff;">Rp.<?= number_format($total_pengeluaran, 2); ?>,-</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-samsat">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Type barang</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="kerusakan">Kerusakan</label>
                                <input type="text" class="form-control" id="kerusakan" name="kerusakan" required>
                            </div>
                            <div class="form-group">
                                <label for="toko">Toko Sparepath</label>
                                <input type="text" class="form-control" id="toko" name="toko" required>
                            </div>
                            <div class="form-group">
                                <label for="pemasukan">Harga User</label>
                                <input type="number" class="form-control" id="pemasukan" name="pemasukan" required>
                            </div>
                            <div class="form-group">
                                <label for="pengeluaran">Modal</label>
                                <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" required>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" id="total" name="total" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="btn-simpan-samsat">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Mengambil elemen input pemasukan dan pengeluaran
            const inputPemasukan = document.getElementById('pemasukan');
            const inputPengeluaran = document.getElementById('pengeluaran');
            const inputTotal = document.getElementById('total');

            // Menambahkan event listener untuk menghitung total saat input berubah
            inputPemasukan.addEventListener('input', updateTotal);
            inputPengeluaran.addEventListener('input', updateTotal);

            function updateTotal() {
                // Mengambil nilai pemasukan dan pengeluaran
                const pemasukan = parseFloat(inputPemasukan.value) || 0;
                const pengeluaran = parseFloat(inputPengeluaran.value) || 0;

                // Menghitung total
                const total = pemasukan - pengeluaran;

                // Memasukkan nilai total ke dalam input total
                inputTotal.value = total;
            }
        </script>

        <script>
            $(document).ready(function() {
                // Tangani pengiriman data samsat saat tombol "Simpan" di modal ditekan
                $('#btn-simpan-samsat').click(function() {
                    // Validasi input data samsat di sini jika diperlukan
                    var dataSamsat = {
                        tanggal: $('#tanggal').val(),
                        nama: $('#nama').val(),
                        kerusakan: $('#kerusakan').val(),
                        toko: $('#toko').val(),
                        pemasukan: $('#pemasukan').val(),
                        pengeluaran: $('#pengeluaran').val(),
                        total: $('#total').val()
                    };

                    // Kirim data samsat menggunakan AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'alat/proses_tambah_data.php',
                        data: dataSamsat,
                        success: function(response) {
                            if (response === 'success') {
                                // Data berhasil ditambahkan, lakukan sesuatu jika diperlukan
                                alert('Data berhasil disimpan');
                                $('#tambahDataModal').modal('hide'); // Tutup modal
                                location.reload(); // Mereset halaman
                            } else {
                                // Menampilkan pesan kesalahan jika ada masalah
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
                            url: 'alat/proses_reset_data.php', // Pastikan path ini benar sesuai dengan lokasi file Anda
                            success: function(response) {
                                if (response.trim() === 'success') { // Menambahkan trim untuk menghapus spasi yang mungkin muncul di respons
                                    alert('Semua data berhasil direset');
                                    location.reload();
                                } else {
                                    alert('Gagal mereset data: ' + response);
                                }
                            },
                            error: function(xhr, status, error) { // Menambahkan handler untuk kesalahan AJAX
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