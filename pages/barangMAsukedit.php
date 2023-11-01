<?php 
include "../koneksi.php";

if (isset($_POST['updatebarang'])) {
    $idm    = $_POST['idm'];
    $idb    = $_POST['idb'];
    $qty    = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    $cekstock   = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $liatstock  = mysqli_fetch_array($cekstock);
    $stocknya   = $liatstock('stock');

    
}
?>