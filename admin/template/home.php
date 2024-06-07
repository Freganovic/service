<?php
// Query untuk mengecek stok barang yang kurang dari atau sama dengan 3
$sql = "SELECT * FROM barang WHERE stok <= 3";
$row = $config->prepare($sql);
$row->execute();
$r = $row->rowCount();

if ($r > 0) {
    echo "
    <div class='alert alert-warning'>
        <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. Silahkan pesan lagi !!
        <span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
    </div>
    ";
}
$sql_konter = "SELECT total FROM konter";
$row_konter = $config->prepare($sql_konter);
$row_konter->execute();
$hasil_konter = $row_konter->fetchAll();

foreach ($hasil_konter as $isi_konter) {
    $total_konter += $isi_konter['total'];
}

$total_total = $total_pemasukan - $total_pengeluaran;

$hasil_barang = $lihat->barang_row();
$hasil_kategori = $lihat->kategori_row();
$stok = $lihat->barang_stok_row();
$jual = $lihat->jual_row();

$total_pemasukan = 0;
$total_pengeluaran = 0;
$total_total = 0;

if (!empty($_GET['cari'])) {
    $periode = $_POST['bln'] . '-' . $_POST['thn'];
    $hasil = $lihat->periode_jual($periode);
} elseif (!empty($_GET['hari'])) {
    $hari = $_POST['hari'];
    $hasil = $lihat->hari_jual($hari);
} else {
    $hasil = $lihat->jual();
}
foreach ($hasil as $isi) {
    $total_pemasukan += $isi['pemasukan'];
    $total_pengeluaran += $isi['pengeluaran'];
    $total_total += $isi['total'];
}
$sql_samsat = "SELECT pemasukan, pengeluaran FROM samsat";
$row_samsat = $config->prepare($sql_samsat);
$row_samsat->execute();
$hasil_samsat = $row_samsat->fetchAll();

foreach ($hasil_samsat as $isi_samsat) {
    $total_pemasukan += $isi_samsat['pemasukan'];
    $total_pengeluaran += $isi_samsat['pengeluaran'];
}

$total_total = $total_pemasukan - $total_pengeluaran;
?>
<?php
$total_total = $total_pemasukan - $total_pengeluaran - $total_konter;
$btotal = $total_total / 2;
?>
<h3 class="fas fa-money-bill"> Rp. <?php echo number_format($btotal); ?>,-</h3>
<p></p>
<br>
<br />
<div class="row justify-content-center">
    <div class="col-md-5 mb-5">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h5 class="card-title"><strong>OMSET TOKO</strong></h5>
                <?php
                $total_total = $total_pemasukan - $total_pengeluaran - $total_konter;
                ?>
                <h4 class="display-5 text-white">
                    Rp. <?php echo number_format($total_total); ?>,-
                </h4>
                <i class="fas fa-money-bill"></i>
            </div>
        </div>
    </div>
</div>
