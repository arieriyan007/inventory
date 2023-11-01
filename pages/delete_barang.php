<?php 
include "../koneksi.php";

if (isset($_POST['deletebarang'])) {
    $idb = $_POST['idb'];

    $gambar = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = '../assets/img/'.$get['image'];
    // untuk menghapus gambar didalam databasenya bisa menggunakan unlink
    unlink($img);

    $deletefile = mysqli_query($koneksi, "DELETE FROM stock WHERE idbarang='$idb' ");
    if ($deletefile) {
        header("location:index.php?pesan=berhasildihapus");
    } else {
        echo "<script>
        alert('Data Stock gagal dihapus !');
        window.location.href='index.php';
        </script>";
    }
}
?>