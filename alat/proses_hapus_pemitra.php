<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Ambil ID mitra dari data POST
    $id = $_POST['id'];

    // Lakukan operasi penghapusan data mitra berdasarkan ID di database
    // ...

    // Jika operasi penghapusan berhasil
    echo 'success';
} else {
    // Jika data ID mitra tidak ditemukan dalam permintaan
    echo 'error';
}
?>
