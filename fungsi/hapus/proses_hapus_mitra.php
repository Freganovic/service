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

// Memeriksa apakah parameter id diterima dari permintaan POST
if (isset($_POST['id'])) {
    // Mendapatkan nilai id dari permintaan POST
    $id = $_POST['id'];

    // Query untuk menghapus data mitra berdasarkan id
    $query = "DELETE FROM mitra WHERE id = $id";

    // Menjalankan query
    if ($koneksi->query($query) === TRUE) {
        // Jika penghapusan berhasil
        echo "success";
    } else {
        // Jika terjadi kesalahan dalam menghapus data
        echo "Gagal menghapus data mitra: " . $koneksi->error;
    }
} else {
    // Jika parameter id tidak diterima
    echo "ID mitra tidak diterima";
}

// Menutup koneksi database
$koneksi->close();
?>
