<?php 
include "../koneksi.php";

if (isset($_POST['addoutbarang'])) {
    $barang     = $_POST['barang'];
    $qty        = $_POST['qty'];
    $penerima   = $_POST['penerima'];

    // cek stock barang
    $cekstock           = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang = '$barang'");
    $ambildatabarang    = mysqli_fetch_array($cekstock);

    // periksa stock barnag sekarang
    $cekstocksekarang   = $ambildatabarang['stock'];
    // kurangangkan cekstoksekarang dengan qty barang keluar
    $kurangkanstock = $cekstocksekarang-$qty;
    
    $datasekarang = mysqli_query($koneksi, "INSERT INTO keluar (idbarang, qty, penerima) VALUES('$barang','$qty','$penerima')");

    // kemudian disini menggunakan logika saat barang sudah di keluarkan maka barang di stock berkurang dan di simpan
    $udpatestock = mysqli_query($koneksi, "UPDATE stock set stock='$kurangkanstock' WHERE idbarang='$barang'");

    if ($datasekarang&&$udpatestock) {
        header("location:keluar.php?status=berhasil");
    } else {
        header("location:keluar.php?status=gagal");
    }

}
?>