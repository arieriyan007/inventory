<?php 
include "../koneksi.php";

if (isset($_POST['addAktiv'])) {
    $nolap      = $_POST['nolap'];
    $lokasi     = $_POST['lokasi'];
    $nama       = $_POST['nama'];
    $prihal     = $_POST['prihal'];
    $ket        = $_POST['ket'];
    $kon        = $_POST['kendala'];
    $evaluasi   = $_POST['evaluasi'];
    $tselesai   = $_POST['tglSelesai'];
    $status     = $_POST['status'];

     // tambah file gambar
     $allow_extention = array ('png', 'jpg', 'heic');
     $nama = $_FILES['file']['name'];
     $dot = explode('.', $nama);
     $ekstensi = strtolower(end($dot));
 
     $ukuran = $_FILES['file']['size'];
     $file_tmp = $_FILES['file']['tmp_name'];
 
     $image = md5(uniqid($nama, true) . time()). '.'.$ekstensi;
 
     // validasi no inventory saat input tida boleh ada yg sama
     $cek = mysqli_query($koneksi, "SELECT * FROM aktivitas_lap WHERE idlap='$'");
     $hitung = mysqli_num_rows($cek);
 
     if ($hitung < 1) {
         if (in_array($ekstensi, $allow_extention) === true) {
             // validasi ukuran file
             if ($ukuran < 10000000) {
                 move_uploaded_file($file_tmp, '../assets/img/' .$image);
                 $tambahinv = mysqli_query($koneksi, "INSERT INTO inventory(no_inventory, namabarang, merk, tgl_pembelian, instalasi, image) VALUES 
                 ('$noinv', '$nmbarang', '$merk', '$tglP', '$inst', '$image') ");
 
                 // jika ada barang maka tidak tersimpan kedatabase
                 if ($tambahinv) {
                     header("location:inventory.php?pesan=berhasildiTambah");
                 } else {
                     echo "<script>
                     alert ('Data gagal ditambahkan !');
                     window.location.href='inventory.php';
                     </script>";
                 }
             } else {
                 // notifikasi jika file lebih dari 10Mb
                 echo "<script>
                 alert ('Ukuran file terlalu besar maksimal 10Mb !');
                 window.location.href='inventory.php';
                 </script>";
             }
         } else {
             // notifikasi file bukan gambar/image
             echo "<script>
             alert ('File harus berupa jpg atau png !');
             window.location.href='inventory.php';
             </script>";
         }
     } else {
         // notifikasi jika no inventory ada
         echo "<script>
         alert ('No inventory sudah ada ! silahkan masukkan no inventory yang baru');
         window.location.href='inventory.php';
         </script>";
     }
}
?>