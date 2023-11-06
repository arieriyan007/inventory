<?php 
include "../koneksi.php";

// panggil name di keluar untuk trigger isset
if (isset($_POST['deletebarang'])) {
    $idk = $_POST['idk'];
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];

    // cek stock terlebih dahulu
    $getstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $data = mysqli_fetch_array($getstock);
    $stock = $data['stock'];

    // tambahkan selisi dari $qty dan $stock setelah dihapus 
    $selisih = $stock+$qty;
    // lakukan update
    $update = mysqli_query($koneksi, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb' ");
    // selanjutnya setelah diupdate stocknya, kemudian baru proses delete barang dan jumlahnya/qty
    $deletebarang = mysqli_query($koneksi, "DELETE FROM keluar WHERE idkeluar='$idk' ");
    if ($update&&$deletebarang) {
        header("location:keluar.php?pesan=berhasildihapus");
    } else {
        echo "<script>
        alert ('Data barang keluar gagal dihapus !');
        window.location.href='keluar.php';
        </script>";
    }
}
?>