<?php 
include "../layouts/header.php";
?>
<!-- style untuk mengetengahkan text td -->
<style>
    td {
        text-align: center;
    }
</style>
<!-- akhir style -->

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
                        <h1 class="mt-4">Stock Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus"></i> Barang baru
                                </button>

                                <!-- membuat export file -->
                                    <a href="export/export.php" class="btn btn-success" target="_blank" title="Data laporan"><i class="fas fa-file-export"></i> Export data</a>
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
                                        <form method="POST" action="tambah_barang.php" enctype="multipart/form-data"> <!-- disini tambahkan enctype="multipart/form-data" karena kita memasukkan file -->
                                        <div class="modal-body">
                                            <input type="text" name="namabarang" id="namabarang" placeholder="Nama Barang" class="form-control" autofocus required="required">
                                            <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi Barang" class="form-control mt-2 mb-2">
                                            <input type="number" name="stock" id="stock" placeholder="Stock Barang" class="form-control my-2" required>
                                            <input type="text" name="satuan" class="form-control my-2" placeholder="Satuan barang">
                                            <input type="file" name="file" class="form-control my-2" aria-label="Upload gambar" required>
                                            <div class="invalid-feedback">Silahkan upload gambar</div>

                                            <button type="submit" class="btn btn-primary" name="addnewbarang">Simpan</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- membuat notifikasi barang stock mendekati habis -->
                                <?php 
                                $datastock = mysqli_query($koneksi, "SELECT * FROM stock WHERE stock < 5");
                                while ($s = mysqli_fetch_array($datastock)) {
                                    $barang = $s['namabarang'];
                                ?>

                                <div class="alert alert-warning alert-dismissible fade show mt-2">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Info!</strong> Stock barang <b><?= $barang; ?></b> hampir habis !, segera lakukan order <?= $barang; ?>
                                </div>

                                <?php 
                                }
                                ?>
                                <!-- akhir notifikasi barang -->
                            <div class="card-body">
                                <table id="datatablesSimple" border="2" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Images</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>         
                                    <tbody>

                                    <?php 
                                    // panggil database
                                    $datastock = mysqli_query($koneksi,"SELECT * FROM stock");
                                    $no=1;

                                    while ($data = mysqli_fetch_array($datastock)) {
                                    $idb        = $data['idbarang'];
                                    $namabarang = $data['namabarang'];
                                    $deskripsi  = $data['deskripsi'];
                                    $stock      = $data['stock']; 
                                    $satuan     = $data['satuan']; 

                                    // upload gambar/images
                                    $gambar     = $data['image'];
                                    if ($gambar==null) {
                                        // if jika gambar tidak ada maka bisa null atau tida ada
                                        $img = 'no images';
                                    } else {
                                        $img = '<img src="../assets/img' .$gambar. ' " class="zoomable">'; //diarahkan ke tempat penyimpanan gambar
                                    }
                                    
                                     ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><a href="detail.php?id=<?= $idb; ?>" style="text-decoration: none; color: black;" title="detail transaksi barang"><?= $namabarang; ?></a></td>
                                            <td><?= $deskripsi; ?></td>
                                            <td><?= $stock; ?></td>
                                            <td><?= $satuan; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>">
                                                <i class="fas fa-edit"></i> Edit
                                                </button>
                                                    <!-- membuat agar mengedit atau mendelete berdasarkan idbarang -->
                                                <input type="hidden" name="idbarangnya" value="<?= $idb; ?>">

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>">
                                                <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit<?= $idb; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Edit-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Edit -->
                                                        <!-- menambahkan enctype="multipart/form-data" -->
                                                        <form method="POST" action="editIndex.php"  enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" autofocus required="required">
                                                            <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control mt-2 mb-2">
                                                            <input type="number" name="stock" value="<?= $stock; ?>" class="form-control" disabled>
                                                            <input type="text" name="satuan" value="<?= $satuan; ?>" class="form-control my-2">
                                                            <input type="file" name="file" id="gambar" class="form-control my-2">
                                                            <div class="invalid-feedback">Silahkan upload gambar !</div>
                                                            <!-- lakukan parshing id barang -->
                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="updatebarang">Update</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Akhir edit -->

                                                    <!-- Delete -->
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete<?= $idb; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Delete-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Info Delete Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Delete -->
                                                        <form method="POST" action="delete_barang.php">
                                                        <div class="modal-body">
                                                            Apakah Ada yakin ingin menghapus <?= $namabarang; ?> ?
                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                            <br>
                                                            <button type="submit" class="btn btn-danger mt-2" name="deletebarang">Delete</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Akhir Delete -->
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
