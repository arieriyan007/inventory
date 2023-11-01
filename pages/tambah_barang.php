<?php 
include '../koneksi.php';

if (isset($_POST['addnewbarang'])) {
    $namabarang =$_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
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

    //validasi barang saat di input sudah ada namanya atau belum
    $cek = mysqli_query($koneksi, "SELECT * FROM stock WHERE namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung<1) {
        // masukkan proses upload gambar juga kedalam validasi namabarang
        if (in_array($ektensi, $allow_extention) === true) {
            // proses validasi ukuran file disini menggunakan ukuran byte
            if ($ukuran < 10000000) {
                move_uploaded_file($file_tmp, '../assets/img' .$image);
                // saat tidak ada barang maka masuk ke tambahbarang
                $tambahbarang = mysqli_query($koneksi, "INSERT INTO stock (namabarang, deskripsi, stock, satuan, image) VALUES ('$namabarang','$deskripsi','$stock', '$satuan', '$image')");
                // dan jika ada barang maka tidak tersimpan kedatabase
                if ($tambahbarang) {
                    header("location:index.php?pesan=berhasilTambah");
                } else {
                    header("location:index.php?pesan=gagalTambah");
                }
            } else {
                // notifikasi jika file lebih dari 10Mb
                echo "<script>
                alert ('Ukuran file terlalu besar maksimal 10Mb !');
                window.location.href='index.php';
            </script>" ;
            }
        } else {
            // notifikasi jika bula file gambar/image
            echo "<script>
                alert ('File bukan jpg/png !, pastikan yang diupload berupa image/gambar');
                window.location.href='index.php';
            </script>" ;
        }
    } else {
        // notifikasi jika nama barang sudah ada
        echo "<script>
        alert ('Nama barang sudah ada ! silahkan cek kembali nama barang yang input');
        window.location.href='index.php';
    </script>" ;
    }

}
?>