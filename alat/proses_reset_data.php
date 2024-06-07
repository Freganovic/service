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

// Query untuk menghapus semua data dari tabel "samsat"
$query = "DELETE FROM samsat";

if ($koneksi->query($query) === TRUE) {
    echo 'success';
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

// Menutup koneksi database
$koneksi->close();
?>
