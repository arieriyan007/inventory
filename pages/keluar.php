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
                        <h1 class="mt-4">Barang Keluar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Barang Kelaur</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus"></i> Barang Keluar
                                </button>

                                <!-- export barang keluar -->
                                <a href="export/exportKeluar.php" class="btn btn-success" target="_blank" title="export laporan keluar"><i class="fas fa-file-export"></i> Export data</a>
                                <!-- akhir export -->
                                
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Barang Keluar</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="barang_keluar.php">
                                        <div class="modal-body">
                                            <select name="barang" id="barang" class="form-control">
                                                <option value="">- pilih barang -</option>
                                                <?php 
                                                $databarang = mysqli_query ($koneksi,"SELECT * FROM stock");
                                                while ($stockbarang = mysqli_fetch_array($databarang)) {
                                                    $nmbarang   = $stockbarang['namabarang'];
                                                    $idbr       = $stockbarang['idbarang'];

                                                ?>

                                                    <option value="<?= $idbr; ?>"><?= $nmbarang; ?></option>

                                                <?php 
                                                }
                                                ?>

                                            </select>
                                            <input type="number" name="qty" id="qty" placeholder="Jumlah Barang Keluar" class="form-control mt-2 mb-2">
                                            <input type="text" name="penerima" id="penerima" placeholder="Penerima Barang" class="form-control mb-2" required>

                                            <button type="submit" class="btn btn-success" name="addoutbarang">Kirim</button>
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
                                <table id="datatablesSimple" border="2" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Images</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Barang</th>
                                            <th>Penerima</th>
                                            <th>Aksi</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php 
                                    $no=1;
                                    // membuat logic saat filter tanggal
                                    if (isset($_POST['filterTgl'])) {
                                        $mulai = $_POST['tglMulai'];
                                        $akhir = $_POST['tglAkhir'];

                                        // menjalankan penyaringan jika tidak dipilih
                                        if ($mulai!=null || $akhir!=null) {
                                            $datakeluar = mysqli_query($koneksi, "SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang AND tanggal BETWEEN '$mulai' AND DATE_ADD('$akhir', INTERVAL 1 DAY) ORDER BY idkeluar DESC ");
                                        } else {
                                            $datakeluar = mysqli_query($koneksi, "SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang ORDER BY idkeluar DESC ");
                                        }
                                    } else {
                                        $datakeluar = mysqli_query($koneksi, "SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang ORDER BY idkeluar DESC ");
                                    }

                                    while ($kl = mysqli_fetch_array($datakeluar)) {
                                        $idb        = $kl['idbarang'];
                                        $idk        = $kl['idkeluar'];
                                        $tanggal    = $kl['tanggal'];
                                        $namabarang = $kl['namabarang'];
                                        $qty        = $kl['qty'];
                                        $penerima   = $kl['penerima'];

                                    // menampilkan gambar
                                    $gambar     = $kl['image'];
                                    if ($gambar==null) {
                                        // if jika gambar tidak ada maka bisa null atau tidak ada
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
                                            <td><?= $penerima; ?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idk; ?>">
                                                <i class="fas fa-edit"></i> Edit
                                                </button>
                                                    <!-- membuat agar mengedit atau mendelete berdasarkan idbarang -->
                                                <input type="hidden" name="idkeluarnya" value="<?= $idk; ?>">
                                                
                                                <button type="button" class="btn btn-danger btn-sm my-1" data-bs-toggle="modal" data-bs-target="#delete<?= $idk; ?>">
                                                <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idk; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Edit-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit barang <?= $namabarang; ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Edit -->
                                                        <form method="POST" action="edit_keluar.php">
                                                        <div class="modal-body">
                                                            <div class="card" style="width: 100%;">
                                                                <div style="text-align: center;" class="mt-2">
                                                                <?= $img; ?>
                                                                </div>
                                                                <div class="card-body row g-2">
                                                                    <div class="col-md-8">
                                                                        <label for="Penerima">Penerima barang :</label>
                                                                        <input type="text" id="Penerima" name="penerima" value="<?= $penerima; ?>" class="form-control mt-2 mb-2">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="Jumlah">Jumlah barang :</label>
                                                                        <input type="number" id="Jumlah" name="qty" value="<?= $qty; ?>" class="form-control mt-2 mb-2">
                                                                        <input type="hidden" name="idk" value="<?= $idk; ?>">
                                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                        <input type="hidden" name="nmbarang" value="<?= $namabarang; ?>">
                                                                    </div>
                                                                </div>       
                                                            </div>

                                                            <!-- Edit footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="updateEdit" class="btn btn-outline-warning" data-bs-dismiss="modal">Update</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Akhir edit -->

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete<?= $idk; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Delete-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Info Delete Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Delete -->
                                                        <form method="POST" action="delete_keluar.php">
                                                        <div class="modal-body">
                                                        <div class="card mb-3" style="max-width: 540px;">
                                                            <div class="row g-0">
                                                                <div class="col-md-4 d-flex justify-content-center" style="width: 100px;">
                                                                <?= $img; ?>
                                                                </div>
                                                                <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center"><?= $namabarang; ?></h5>
                                                                    <hr>
                                                                    <p class="card-text text-center">Jumlah : <?= $qty; ?></p>
                                                                    <hr>
                                                                    <p class="card-text text-center"><small class="text-muted"><?= $tanggal; ?></small></p>

                                                                    <!-- input dengan type hidden -->
                                                                    <input type="hidden" name="idk" value="<?= $idk; ?>">
                                                                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                    <input type="hidden" name="qty" value="<?= $qty; ?>">
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-secondary" name="deletebarang">Delete</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Akhir Delete -->
                                        </tr>
                                    
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