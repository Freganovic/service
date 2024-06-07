<?php
// Pastikan file ini diakses melalui permintaan POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir tambah mitra
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_join = $_POST['tanggal_join'];
    $lokasi = $_POST['lokasi'];
    $telepon = $_POST['telepon'];

    // Validasi data jika diperlukan
    // Misalnya, pastikan semua data telah diisi dengan benar

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

    // Query SQL untuk menambahkan data mitra dengan prepared statement
    $query = "INSERT INTO pemitra (nama, alamat, tanggal_join, lokasi, telepon) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssss", $nama, $alamat, $tanggal_join, $lokasi, $telepon);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $query . "<br>" . $stmt->error;
    }

    // Menutup koneksi database
    $stmt->close();
    $koneksi->close();
}
