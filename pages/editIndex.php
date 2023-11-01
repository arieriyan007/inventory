<?php 
include "../koneksi.php";

if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $nbarang = $_POST['namabarang'];
    $desk = $_POST['deskripsi'];
    $satuan = $_POST['satuan'];

    // tambahkan file gambar
    $allow_extention = array('png', 'jpg'); //hanya file gambar png, jpg, dan jpeg saja yg boleh diupload
    $nama = $_FILES['file']['name']; //default nama gambar
    $dot = explode('.',$nama);
    $ektensi = strtolower(end($dot)); //mengambil ektensi dari $dot 

    // lanjut membuat ukuran file gambar/image
    $ukuran = $_FILES['file']['size']; //ambil size/ukuran dari filenya
    $file_tmp = $_FILES['file']['tmp_name']; // ini untuk mengambil lokasi filennya

    // dilanjutnya memberikan penaam file didatabase -> kemudian di enctryp ke md5
    $image = md5(uniqid($nama,true) . time()). '.'.$ektensi; //menggabungkan nama file yg di enkripsi dengan $ekstensi

    // jika tidak ada perubahan pada gambar maka tidak ada perubahan apapun dengan gambar
    if ($ukuran==0) {
        // jika tidak ingin diupload 
        $updatestock = mysqli_query($koneksi, "UPDATE stock SET namabarang='$nbarang', deskripsi='$desk', satuan='$satuan' WHERE idbarang='$idb'");

        if ($updatestock) {
            header("location:index.php?pesan=behasilUpdate");
        } else {
            header("location:index.php?pesan=gagalUpdate");
        }
    } else {
        // jika gambar diganti dengan yang baru
        move_uploaded_file($file_tmp, '../assets/img'.$image);
        $updatestock = mysqli_query($koneksi, "UPDATE stock SET namabarang='$nbarang', deskripsi='$desk', satuan='$satuan', image='$image' WHERE idbarang='$idb'");

        // kembalikan kehalaman index
        if ($updatestock) {
            header("location:index.php?pesan=behasilUpdate");
        } else {
            header("location:index.php?pesan=gagalUpdate");
        }
    }
}
?>