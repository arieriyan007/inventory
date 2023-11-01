<?php 

session_start();

//  membuat koneksi dengan database
$koneksi = mysqli_connect("localhost","root","","stokbarang");

if (mysqli_connect_errno()) {
    echo "gagal terhubung ke server database !";
}
?>