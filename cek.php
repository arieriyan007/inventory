<?php 

// jika belum login maka kembali ke halaman login

if (isset($_SESSION['log'])) {
    # code...
} else {
    header("location:../index.php?pesan=logingagal");
}
?>