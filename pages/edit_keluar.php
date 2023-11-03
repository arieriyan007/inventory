<?php 
include "../koneksi.php";

if (isset($_POST['updateEdit'])) {
    $idk    = $_POST['idk'];
    $idb    = $_POST['idb'];
    $nmbarang   = $_POST['nmbarang'];
    $penerima   = $_POST['penerima'];
    $qty        = $_POST['qty']; // QTY/jumlah yang baru diinput 

    // stock barang saat ini
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $stock = mysqli_fetch_array($cekstock);
    $stocksekarang = $stock['stock'];

    // jumlah/Quantity barang keluar saat ini
    $qtyskrng = mysqli_query($koneksi, "SELECT * FROM keluar WHERE idkeluar='$idk' ");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtysaatini = $qtynya['qty'];

    // logika stock diatas dibuat ke if 
    if ($qty > $qtysaatini) {
        // maka hitung selisih qtynya
        $selisih = $qty-$qtysaatini;
        $kurangin = $stocksekarang - $selisih;

        // membuat validation/notifikasi jika QTY sudah mendekati barang habis
        if ($selisih <= $qtysaatini) {
            // maka operasinya 
            $kuranginstock = mysqli_query($koneksi, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb' ");
            $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk' ");

            // jika logika diatas benar maka
            if ($kuranginstock&&$udpatestock) {
                header("location:keluar.php?pesan=updatekeluarberhasil");
            } else {
                echo "<script>
                alert ('Edit data barang <?= $nmbarang; ?> !');
                window.location.href='keluar.php';
                </script>";
            }
        } else {
            echo "<script>
            alert ('Stock barang tidak mencukupi !');
            window.location.href='keluar.php';
            </script>";
        }
        // akhir membuat validasi dan notifikasi jika barang di edit melebih stock saat ini
    } else {
        $selisih = $qtysaatini-$qty; // jumlah qty saat ini di kurangin dengan qty yang baru di edit
        // operasinya
        $tambahkan = $stocksekarang + $selisih;
        $tambahkanstock = mysqli_query($koneksi, "UPDATE stock SET stock='$tambahkan' WHERE idbarang='$idb' ");
        $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk' ");

        // jika logika diatas benar maka halaman akan dialihkan ke halaman baru
        if ($tambahkanstock&&$updatestock) {
            header("location:keluar.php?pesan=updatekeluarberhasil");
        } else {
            echo "<script>
            alert ('Info ! Edit barang gagal diupdate');
            window.location.href='keluar.php';
            </script>";
        }
    }
}
?>