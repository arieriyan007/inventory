<?php 
include "../koneksi.php";

if (isset($_POST['addUser'])) {
    $name = $_POST['uname'];
    $pass = md5($_POST['pass']);

    // inset user kedalam database
    $adduser = mysqli_query($koneksi, "INSERT INTO login (username, password) VALUES ('$name', '$pass')");

    // kembali kehalaman admin
    if ($adduser) {
        header("location:user.php?info=userditambah");
    } else {
        header("location:user.php?info=gagaltambahuser");
    }
}
?>