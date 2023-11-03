<?php 
include "../koneksi.php";

if (isset($_POST['addAktivitas'])) {
    $nolap      = $_POST['nolap'];
    $lokasi     = $_POST['lokasi'];
    $nama       = $_POST['nama'];
    $prihal     = $_POST['prihal'];
    $ket        = $_POST['ket'];
    $ken        = $_POST['kendala'];
    $evaluasi   = $_POST['evaluasi'];
    $tselesai   = $_POST['tglSelesai'];
    $status     = $_POST['status'];

     // tambah file gambar
     $allow_extention = array ('png','jpg','heic');
     $nama = $_FILES['file']['name'];
     $dot = explode('.', $nama);
     $ekstensi = strtolower(end($dot));
 
     $ukuran = $_FILES['file']['size'];
     $file_tmp = $_FILES['file']['tmp_name'];
 
     $image = md5(uniqid($nama, true) . time()). '.'.$ekstensi;
 
     // validasi no laporan saat diinput tidak boleh ada yg sama
     $cek = mysqli_query($koneksi, "SELECT * FROM aktivitas_lap WHERE no_lap='$nolap' ");
     $hitung = mysqli_num_rows($cek);
 
     if ($hitung < 1) {
         if (in_array($ekstensi, $allow_extention) === true) {
             // validasi ukuran file
             if ($ukuran < 3000000) {
                 move_uploaded_file($file_tmp, '../assets/img_laporan/' .$image);
                 $tambah = mysqli_query($koneksi, "INSERT INTO aktivitas_lap (idpeg, no_lap, lokasi, nama_laporan, keterangan, kendala, evaluasi, tgl_selesai, status, image) VALUES ('$nama', '$nolap', '$lokasi', '$prihal', '$ket', '$ken', '$evaluasi', '$tselesai', '$status', '$image') ");
 
                 // jika ada barang maka tidak tersimpan kedatabase
                 if ($tambah) {
                     header("location:aktivitas_IT.php?pesan=LaporanberhasildiTambah");
                 } else {
                     echo "<script>
                     alert ('Data laporan gagal ditambahkan !');
                     window.location.href='aktivitas_IT.php';
                     </script>";
                 }
             } else {
                 // notifikasi jika file lebih dari 3Mb
                 echo "<script>
                 alert ('Ukuran file terlalu besar maksimal 3Mb !');
                 window.location.href='aktivitas_IT.php';
                 </script>";
             }
         } else {
             // notifikasi file bukan gambar/image
             echo "<script>
             alert ('File harus berupa jpg, png, atau heic !');
             window.location.href='aktivitas_IT.php';
             </script>";
         }
     } else {
         // notifikasi jika no laporan ada
         echo "<script>
         alert ('No Laporan sudah ada ! silahkan masukkan no laporan yang baru');
         window.location.href='aktivitas_IT.php';
         </script>";
     }
}
?>