<?php 
include "../koneksi.php";

if (isset($_POST['addinbarang'])) {
    $barang     = $_POST['barangMasuk'];
    $penerima   = $_POST['penerima'];
    $qty        = $_POST['qty'];

    // cek stock barang di data stock
    $cekstock = mysqli_query($koneksi,"SELECT * FROM stock WHERE idbarang = '$barang'");
    $ambildatabarang = mysqli_fetch_array($cekstock);

    $stocksekarang = $ambildatabarang['stock'];
    // menambahkan stock yang ada dari qty ke stock barang
    $tambahstock = $stocksekarang+$qty;

    $tambahdata = mysqli_query($koneksi,"INSERT INTO masuk (idbarang, qty, keterangan) VALUES ('$barang','$qty','$penerima')");

    $udpatestock = mysqli_query($koneksi,"UPDATE stock set stock='$tambahstock' WHERE idbarang='$barang' ");
    if ($tambahdata&&$udpatestock) {
    header("location:masuk.php?status=berhasil");
    } else {
        
        header("location:masuk.php?status=gagal");
    }
}
?>