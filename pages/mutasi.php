<?php 
include "../koneksi.php";

if (isset($_POST['mutasiBarang'])) {
    $idv        = $_POST['idv'];
    $tglM       = $_POST['tglmutasi'];
    $pmutasi    = $_POST['pmutasi'];
    
    $updatedata = mysqli_query($koneksi, "UPDATE inventory SET tgl_mutasi='$tglM', instalasi='$pmutasi' WHERE id_inv='$idv'");

    if ($updatedata) {
        header("location:inventory.php?pesan=berhasilmutasi");
    } else {
        echo "<script>
        alert('Mutasi barang gagal dibuat !');
        window.location.href:inventory.php;
        </script>";
    }
}
?>