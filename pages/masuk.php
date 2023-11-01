<?php 
include "../layouts/header.php";
?>

<style>
    td {
        text-align: center;
    }
</style>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Barang Masuk</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus"></i> Barang Masuk
                            </button>

                            <!-- button export -->
                            <a href="export/exportMasuk.php" class="btn btn-success" target="_blank" title="export laporan masuk"><i class="fas fa-file-export"></i> Export data</a>
                            <!-- akhir export -->

                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Barang Masuk</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="barang_masuk.php">
                                        <div class="modal-body">
                                            <!-- membuat select data -->
                                            <select name="barangMasuk" id="barangMasuk" class="form-control">
                                                <?php 
                                                $databarang = mysqli_query($koneksi,"SELECT * FROM stock");
                                                while ($barang = mysqli_fetch_array($databarang)) {
                                                    $nmbarang = $barang['namabarang'];
                                                    $idbr = $barang['idbarang'];
                                                ?>

                                                <option value="<?= $idbr; ?>"><?= $nmbarang; ?></option>
                                                
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            <input type="number" name="qty" id="qty" placeholder="Jumlah Barang Masuk" class="form-control mt-2 mb-2" required>
                                            <input type="text" name="penerima" id="penerima" placeholder="Penerima Barang" class="form-control mt-2 mb-2">

                                            <button type="submit" class="btn btn-primary" name="addinbarang">Simpan</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- filter tanggal -->
                        <div class="row">
                            <div class="col-md-6">
                                <b class="d-flex justify-content-center text-center my-3">Filter tanggal mulai dan tanggal akhir</b>
                                <form method="POST" class="d-flex form-inline" style="align-items: space-between;">
                                &nbsp;&nbsp; <input type="date" name="tglMulai" class="form-control" title="Tanggal mulai">&nbsp;
                                    <input type="date" name="tglAkhir" class="form-control" title="Tanggal akhir">
                                    &nbsp;<button name="filterTgl" type="submit" class="btn btn-info">Filter</button>
                                </form>
                            </div>
                        </div>
                        <!-- akhir filter tanggal -->
                            <div class="card-body">
                                <table id="datatablesSimple" border="2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Images</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal</th>
                                            <th>Qty</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php 
                                    $no=1;
                                    // memasukkan logic filter
                                    if (isset($_POST['filterTgl'])) {
                                        $mulai = $_POST['tglMulai'];
                                        $akhir = $_POST['tglAkhir'];

                                        if ($mulai!=null || $akhir!=null) {
                                            $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s WHERE s.idbarang=m.idbarang AND tanggal BETWEEN '$mulai' AND DATE_ADD('$akhir', INTERVAL 1 DAY) ORDER BY idmasuk DESC");
                                        } else {
                                            $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s WHERE s.idbarang=m.idbarang ORDER BY idmasuk DESC");
                                        }

                                    } else {
                                        // jika tidak ada maka data dikembalikan secara berurutan
                                        $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s WHERE s.idbarang=m.idbarang ORDER BY idmasuk DESC");
                                    }

                                    while ($masuk = mysqli_fetch_array($datamasuk)) {
                                        $idm    = $masuk['idmasuk'];
                                        $idb    = $masuk['idbarang'];   
                                        $namabarang = $masuk['namabarang'];
                                        $tanggal    = $masuk['tanggal'];
                                        $qty        = $masuk['qty'];
                                        $keterangan = $masuk['keterangan'];
                                        
                                        // upload gambar/images dan menampilkan gambar
                                        $gambar     = $masuk['image'];
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
                                            <td><?= $namabarang; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $keterangan; ?></td>
                                            <td>
                                                <!-- edit modal -->
                                            <button type="button" class="btn btn-info btn-sm" title="Edit Barang" data-bs-toggle="modal" data-bs-target="#edit<?= $idm; ?>"><i class="fas fa-edit"></i> Edit
                                            </button>

                                                <!-- modal ID -->
                                            <div class="modal fade" id="edit<?= $idm; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <!-- header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang <?= $namabarang; ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    
                                                    <!-- body -->
                                                    <form action="barangMasukedit.php" method="POST"></form>
                                                    <div class="modal-body">
                                                        <input type="number" name="qty" class="form-control" value="<?= $qty; ?>" autofocus>
                                                        <input type="text" name="keterangan" class="form-control my-2" value="<?= $keterangan; ?>" required>

                                                        <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" name="updatebarang"> Simpan</button>
                                                    </div>

                                                    </div>
                                                </div>    
                                            </div>
                                                <!-- akhir edit modal -->

                                                <!-- hapus modal -->
                                                <button class="btn btn-danger btn-sm" title="Hapus Barang"><i class="fas fa-trash"></i> Hapus</button>
                                                <!-- akhir hapus modal -->
                                            </td>
                                            
                                        </tr>
                                    
                                    <?php 
                                    };
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
