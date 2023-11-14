<?php 
include "../koneksi.php";

if (isset($_POST['deleteuser'])) {
    $idu = $_POST['idu'];

    $deleteuser = mysqli_query($koneksi, "DELETE FROM login WHERE iduser='$idu' ");

    if ($deleteuser) {
        echo "<script>
        alert('Data user berhasil di hapus');
        window.location.href='user.php';
        </script>";
    } else {
        echo "<script>
        alert ('Data user gagal di hapus !');
        window.location.href='user.php';
        </script>";
    }
}
?>