<?php 
include "../layouts/header.php";
?>

<div id="layoutSidenav_content">
                <main>

                <?php 
                if (isset($_GET['status'])) {
                    if ($_GET['status']=='berhasil') {
                        echo "<div class='alert alert-primary text-center mt-2' role='alert'><marquee><b>Selamat Datang di Aplikasi Stock Barang</b></marquee></div>";
                    } 
                    // elseif ($_GET['status']=='gagal') {
                    //     echo "<div class='alert alert-warning text-center mt-2' role='alert'><b>Silahkan Logout terlebih dahulu !</b></div>";
                    // }
                }
                ?>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Inventory IT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Perangkat barang IT RSMP</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-box-open"></i> Inventory baru
                                </button>

                                <!-- membuat export file -->
                                    <a href="export/exportinventory.php" class="btn btn-success" target="_blank" title="Data laporan"><i class="fas fa-file-export"></i> Export data</a>
                                <!-- akhir export file -->

                                <!-- The Modal -->
                                    <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Barang</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="tambah_inventory.php" enctype="multipart/form-data"> <!-- disini tambahkan enctype="multipart/form-data" karena kita memasukkan file -->
                                        <div class="modal-body">
                                            <input type="text" name="noinv" placeholder="No Inventory" class="form-control" autofocus required="required">
                                            <input type="text" name="namabarang" id="namabarang" placeholder="Nama Barang" class="form-control my-2" autofocus required="required">
                                            <input type="text" name="merk"  placeholder="Merk barang" class="form-control my-2">
                                            <label for="tgl"> Tanggal barang datang</label>
                                            <input type="date" name="tgl" id="tgl" class="form-control" required>
                                            <input type="text" name="inst" class="form-control my-2" placeholder="Posisi barang">
                                            <input type="file" name="file" class="form-control my-2" aria-label="Upload gambar">
                                            <div class="invalid-feedback">Silahkan upload gambar</div>

                                            <button type="submit" class="btn btn-primary" name="addinv">Simpan</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            <div class="card-body">
                                <!-- notifikasi berhasil -->
                                <?php 
                                if (isset($_GET['pesan'])) {
                                    if ($_GET['pesan']=='berhasilmutasi') {
                                        echo '<div class="alert alert-primary alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Behasil</strong> melakukan mutasi barang ke unit/instalasi baru.
                                      </div>';
                                    } elseif ($_GET['pesan']=='berhasildiTambah') {
                                        echo '<div class="alert alert-primary alert-dismissible text-center">
                                        <strong>Behasil</strong> melakukan penambahan inventory baru.
                                      </div>';
                                      echo "<meta http-equiv=refresh content=2;URL='inventory.php'>";
                                    } 
                                    
                                }
                                ?>
                                <!-- akhir notifikasi -->
                                <table id="datatablesSimple" border="2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No Inv</th>
                                            <th>Images</th>
                                            <th>Nama Barang</th>
                                            <th>Merk barang</th>
                                            <th>Tgl Pembelian</th>
                                            <th>Posisi barang</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>         
                                    <tbody>

                                    <?php 
                                    // panggil database
                                    $datainv = mysqli_query($koneksi,"SELECT * FROM inventory");
                                    while ($i = mysqli_fetch_array($datainv)) {
                                    $idv        = $i['id_inv'];
                                    $noinv      = $i['no_inventory'];
                                    $merk       = $i['merk'];
                                    $nmbarang   = $i['namabarang'];
                                    $tgl        = $i['tgl_pembelian'];
                                    $inst       = $i['instalasi'];

                                    // upload gambar/images
                                    $gambar     = $i['image'];
                                    if ($gambar==null) {
                                        // if jika gambar tidak ada maka bisa null atau tida ada
                                        $img = 'no images';
                                    } else {
                                        $img = '<img src="../assets/img/'.$gambar.' " class="zoomable">'; //diarahkan ke tempat penyimpanan gambar
                                    }
                                    
                                     ?>

                                        <tr>
                                            <td><?= $noinv; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><?= $nmbarang; ?></td>
                                            <td><?= $merk; ?></td>
                                            <td><?= $tgl; ?></td>
                                            <td><?= $inst; ?></td>
                                            <td>
                                                <div class="row g-3 inliner">
                                                <!-- button mutasi barang -->
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#mutasi<?= $idv; ?>">
                                                    <i class="fas fa-exchange-alt"></i> Mutasi
                                                </button>
                                                <!-- button barang rusak -->
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rusak<?= $idv; ?>">
                                                    <i class="fas fa-wrench"></i> rusak
                                                </button>
                                                <!-- button barang rusak -->
                                                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#print<?= $idv; ?>">
                                                    <i class="fas fa-print"></i> print kartu
                                                </button>
                                                <!-- membuat agar mengedit atau mendelete berdasarkan idbarang -->
                                            <input type="hidden" name="idvnya" value="<?= $idv; ?>">
                                            </div>
                                            </td>
                                        </tr>

                                                    <!-- Mutasi Modal -->
                                                    <div class="modal fade" id="mutasi<?= $idv; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                
                                                                <!-- Modal Header Mutasi-->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Mutasi barang inventory</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>

                                                        <!-- Modal body Mutasi -->
                                                        <!-- menambahkan enctype="multipart/form-data" -->
                                                        <form method="POST" action="mutasi.php"  enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <!-- memasukkan gambar sebagai tumbnile -->
                                                            <div class="container">
                                                        <h2 class="text-center"><?= $noinv; ?></h2>
                                                            <div class="card" style="text-align: center; max-width: 500px;">
                                                            <div class="mt-2" style="text-align: center;">
                                                                <?= $img; ?>
                                                            </div>
                                                                <div class="card-body">
                                                                <h4 class="card-title text-center"><?= $nmbarang; ?></h4>
                                                                <p class="card-text text-center"><?= $merk; ?></p>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="form-floating my-2">
                                                                <input type="text" name="tgl" id="tgl" value="<?= $tgl; ?>" class="form-control" disabled>
                                                                <label for="tgl">Tgl pembelian :</label>
                                                            </div>
                                                            <div class="form-floating my-2">
                                                                <input type="text" name="posisi" id="posisi" value="<?= $inst; ?>" class="form-control" disabled>
                                                                <label for="posisi">Posisi barang :</label>
                                                            </div>
                                                            <!-- <input type="file" name="file" id="gambar" class="form-control my-2">
                                                            <div class="invalid-feedback">Silahkan upload gambar !</div> -->
                                                            <div class="form-floating my-2">
                                                                <input type="date" name="tglmutasi" id="tglMutasi" class="form-control" required>
                                                                <label for="tglMutasi">Tgl mutasi barang :</label>
                                                            </div>
                                                            <div class="form-floating">
                                                                <input type="text" name="pmutasi" id="pMutasi" class="form-control" required>
                                                                <label for="pMutasi">Mutasi barang ke unit/instalasi :</label>
                                                            </div>
                                                            <!-- lakukan parshing id barang -->
                                                            <input type="hidden" name="idv" value="<?= $idv; ?>">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-primary" name="mutasiBarang">Mutasi</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Akhir edit -->

                                    <?php 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

<?php 
include "../layouts/footer.php";
?>