<?php 
include "../koneksi.php";

if (isset($_POST['uploadsave'])) {
    $ndokumen   = $_POST['ndokumen'];
    $ket        = $_POST['keterangan'];
    
    // upload gambar di php
    $allow_extention = array ('pdf', 'docs');
    $nama = $_FILES['file']['name'];
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot));

    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $dokumen = $nama=true . time(). '.'.$ekstensi;

    // validasi upload dokumen nama dokumen tidak boleh sama
    $cek = mysqli_query($koneksi, "SELECT * FROM upload WHERE nama_dokumen='$ndokumen' ");
    $hitung = mysqli_num_rows($cek);

    if ($hitung < 1) {
        if (in_array($ekstensi, $allow_extention) === true) {
            // validasi ukuran file
            if ($ukuran < 1500000) { 
                move_uploaded_file($file_tmp, '../assets/img_dokumen/' .$dokumen);
                $dataupload = mysqli_query($koneksi, "INSERT INTO upload(nama_dokumen, keterangan, file) VALUES 
                ('$ndokumen', '$ket', '$dokumen') ");

                if ($dataupload) {
                    header("location:serah_terima.php?pesan=berhasilmenambahkandataupload");
                } else {
                    echo "<script>
                    alert ('Data dokumen gagal ditambahkan kedatabase !');
                    window.location.href='serah_terima.php';
                    </script>";
                }
    } else {
        // notifikasi jika file lebih dari 10Mb
        echo "<script>
        alert ('Ukuran file terlalu besar maksimal 10Mb !');
        window.location.href='serah_terima.php';
        </script>";
    }
        } else {
            // notifikasi file bukan pdf/word
            echo "<script>
            alert ('File harus berupa pdf !');
            window.location.href='serah_terima.php';
            </script>";
        }
    } else {
        // notifikasi jika no inventory ada
        echo "<script>
        alert ('Nama dokumen sudah ada ! silahkan masukkan nama dokumen yang baru');
        window.location.href='serah_terima.php';
        </script>";
    }
}
?>