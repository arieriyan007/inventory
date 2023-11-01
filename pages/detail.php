<?php 
include "../layouts/header.php";
// ambil atau GET idbarangnya agar bisa digunakan 
$idbarang = $_GET['id'];
// selanjutnya querykan idbarangnya yg di get
$get = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idbarang' ");
$fetch = mysqli_fetch_array($get);
// set variabel datanya
$namabarang   = $fetch['namabarang'];
$deskripsi    = $fetch['deskripsi'];
$stock        = $fetch['stock'];
$satuan       = $fetch['satuan'];

// memuat gambar/image
$gambar = $fetch['image']; //ambil database gambar
if ($gambar==null) { //jika gambar tidak ada maka boleh null
    // gambar jika tidak ada maka tampil no image
    $img = 'No Images';
} else {
    // jika ada gambar maka tampilkan
    $img = '<img src="../assets/img'.$gambar.'" class="zoomable">';
}
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 text-center">Detail Stock Barang</h1>
                        <ol class="breadcrumb mb-4">
                           <marquee behavior="" direction=""> <li class="breadcrumb-item active">Detail barang masuk dan keluar saat ini</li> </marquee>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="col-md-12 mt-2" style="text-align: center;">
                                    <?= $img; ?>
                                    <h4 class="mt-2"><?= $namabarang; ?></h4>
                                </div>
                            <div class="card-body">
                                <hr>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">Deskripsi : <b><?= $deskripsi; ?></b></div>
                                    <div class="col-md-12" style="text-align: center;">Stock sekarang : <?= $stock; ?> <?= $satuan; ?></div>
                                </div>
                               
                                <hr>
                                <!-- barang masuk -->
                                <h3>Barang masuk</h3>
                                <div class="table-responsive">
                                    <table id="barangMasuk" border="2" class="table table-bordered table-hover" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Quantity</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
    
                                        <?php 
                                        $no=1;
                                        $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk WHERE idbarang='$idbarang' ORDER BY idmasuk DESC");
                                        while ($m = mysqli_fetch_array($datamasuk)) {
                                            $tanggal    = $m['tanggal'];
                                            $qty        = $m['qty'];
                                            $ket        = $m['keterangan'];
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $ket; ?></td>
                                                <td><?= $qty; ?></td>
                                            </tr>
                                        
                                        <?php 
                                        }
                                        ?>    
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- akhir barang masuk -->
                                <hr>
                                <!-- barang keluar -->
                                <h3>Barang keluar</h3>
                                <div class="table-responsive">
                                    <table id="barangMasuk" border="2" class="table table-bordered table-hover" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Quantity</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
    
                                        <?php 
                                        $no=1;
                                        $datakeluar = mysqli_query($koneksi, "SELECT * FROM keluar WHERE idbarang='$idbarang' ORDER BY idkeluar DESC");
                                        while ($k = mysqli_fetch_array($datakeluar)) {
                                            $tgl        = $k['tanggal'];
                                            $quantity   = $k['qty'];
                                            $penerima   = $k['penerima'];
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tgl; ?></td>
                                                <td><?= $penerima; ?></td>
                                                <td><?= $quantity; ?></td>
                                            </tr>
                                        
                                        <?php 
                                        }
                                        ?>    
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- akhir barang keluar -->
                            </div>
                        </div>
                    </div>
                </main>
<?php 
include "../layouts/footer.php";
?>
