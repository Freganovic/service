<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_toko";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$id = $_POST['id'];
$query = "SELECT * FROM mitra WHERE id = $id";
$result = $koneksi->query($query);

if ($result) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Gagal mengambil data mitra']);
}

$koneksi->close();
?>
