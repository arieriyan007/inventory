<?php 
include "../koneksi.php";

if (isset($_POST['addperawatan'])) {
    $lokasi     = $_POST['lokasi'];
    $tgl        = $_POST['tgl'];
    $nama       = $_POST['nama'];
    $cpu        = $_POST['cpu'];
    $perangkat  = $_POST['perangkat'];
    $kabel      = $_POST['kabel'];
    $so         = $_POST['so'];
    $hardisk    = $_POST['hardisk'];
    $av         = $_POST['antivirus'];
    $apps       = $_POST['aplikasi'];
    $jaringan   = $_POST['jaringan'];

    $dataperbaikan = mysqli_query($koneksi, "INSERT INTO perawatan (idpeg, tgl, lokasi, cpu, perangkat, kabel, windows, hardisk, antivirus, aplikasi, jaringan) 
    VALUES ('$nama' )");
}
?>