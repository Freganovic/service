<?php
// Pastikan Anda mengganti informasi koneksi database berikut
$host = "localhost";
$username = "root";
$password = "";
$database = "db_toko";

// Ambil data yang dikirimkan melalui AJAX
$tanggal = $_POST['tanggal'];
$nama = $_POST['nama'];
$pemasukan = $_POST['pemasukan'];
$pengeluaran = $_POST['pengeluaran'];
$total = $_POST['total'];

// Buat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Buat query untuk menambahkan data ke tabel "jati"
$query = "INSERT INTO jati (tanggal, nama, pemasukan, pengeluaran, total) VALUES ('$tanggal', '$nama', '$pemasukan', '$pengeluaran', '$total')";

if ($koneksi->query($query) === TRUE) {
    // Data berhasil ditambahkan
    echo 'success';
} else {
    echo "Gagal menambahkan data: " . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
