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
$tanggal = $_POST['tanggal'];
$nama = $_POST['nama'];
$cup_jumbo = $_POST['cup_jumbo'];
$nominal = $_POST['nominal'];
$status = $_POST['status'];

$query = "UPDATE mitra SET tanggal = '$tanggal', nama = '$nama', cup_jumbo = '$cup_jumbo', nominal = '$nominal', status = '$status' WHERE id = $id";
if ($koneksi->query($query) === TRUE) {
    echo 'success';
} else {
    echo 'Gagal mengupdate data mitra: ' . $koneksi->error;
}

$koneksi->close();
?>
