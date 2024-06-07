<?php
// Konfigurasi koneksi database
$host = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "db_toko"; // Ganti dengan nama database Anda

try {
    $config = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $config->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['pemitra']) && $_GET['pemitra'] == 'tambah') {
    // Ambil data yang dikirim melalui POST
    $namaPemitra = $_POST['pemitra'];

    // Validasi data jika diperlukan
    if (empty($namaPemitra)) {
        echo "Nama Pemitra harus diisi.";
        exit;
    }

    // Persiapan query SQL untuk memasukkan data pemitra ke dalam database
    $sql = "INSERT INTO pemitra (nama) VALUES (:nama)";

    try {
        // Persiapkan pernyataan SQL menggunakan PDO
        $stmt = $config->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':nama', $namaPemitra, PDO::PARAM_STR);

        // Eksekusi query SQL
        if ($stmt->execute()) {
            echo 'success'; // Berhasil menambahkan data
        } else {
            echo 'Gagal menambahkan data pemitra';
        }
    } catch (PDOException $e) {
        echo 'Gagal menambahkan data pemitra: ' . $e->getMessage();
    }
} else {
    echo 'Aksi tidak valid.';
}
