<h1>Hj Pendi</h1>
<!-- view barang -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="example1">
                <thead>
                    <tr style="background:#DFF0D8;color:#333;">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th style="width:10%;">Pemasukan</th>
                        <th style="width:10%;">Pengeluaran</th>
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

                    // Query untuk mengambil data dari tabel "pendi"
                    $query = "SELECT * FROM pendi";
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
                        <th colspan="3">Total</th>
                        <th>Rp.<?= number_format($total_pemasukan, 2); ?>,-</th>
                        <th>Rp.<?= number_format($total_pengeluaran, 2); ?>,-</th>
                        <th>Rp.<?= number_format($total_total, 2); ?>,-</th>
                    </tr>
                </tfoot>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Hj Pendi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-pendi">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="pemasukan">Pemasukan</label>
                        <input type="number" class="form-control" id="pemasukan" name="pemasukan" required>
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Pengeluaran</label>
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
                <button type="button" class="btn btn-primary" id="btn-simpan-pendi">Simpan</button>
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
        // Tangani pengiriman data pendi saat tombol "Simpan" di modal ditekan
        $('#btn-simpan-pendi').click(function() {
            // Validasi input data pendi di sini jika diperlukan
            var dataPendi = {
                tanggal: $('#tanggal').val(),
                nama: $('#nama').val(),
                pemasukan: $('#pemasukan').val(),
                pengeluaran: $('#pengeluaran').val(),
                total: $('#total').val()
            };

            // Kirim data pendi menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: 'alat/proses_tambah_pendi.php',
                data: dataPendi,
                success: function(response) {
                    if (response === 'success') {
                        // Data berhasil ditambahkan, lakukan sesuatu jika diperlukan
                        alert('Data Pendi berhasil disimpan');
                        $('#tambahDataModal').modal('hide'); // Tutup modal
                        location.reload(); // Mereset halaman

                        // Tambahkan kode lain yang perlu dijalankan setelah data disimpan
                    } else {
                        // Menampilkan pesan kesalahan jika ada masalah
                        alert('Gagal menyimpan data Pendi: ' + response);
                    }
                }
            });
        });
    });
</script>