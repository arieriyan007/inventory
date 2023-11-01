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
                        <h1 class="mt-4">Berkas berita acara</h1>
                        <ol class="breadcrumb mb-4">
                           <marquee behavior="" direction=""> <li class="breadcrumb-item active">Upload dokumen/berkas berita acara yang sudah di tanda tangani</li></marquee>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dokumen">
                                <i class="fas fa-plus"></i> Upload berkas baru
                            </button>

                            <!-- button export -->
                            <!-- <a href="export/exportMasuk.php" class="btn btn-success" target="_blank" title="export laporan masuk"><i class="fas fa-file-export"></i> Export data</a> -->
                            <!-- akhir export -->

                            <!-- The Modal -->
                            <div class="modal fade" id="dokumen">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Upload dokumen baru</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="tambah_upload.php" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-floating">
                                                <input type="text" name="ndokumen" id="namaDokumen" placeholder="Nama dokumen" class="form-control mt-2 mb-2" required>
                                                <label for="namaDokumen">Nama Dokumen :</label>
                                            </div>
                                            <div class="form-floating">
                                                <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan dokumen" class="form-control mt-2 mb-2">
                                                <label for="keterangan">Keterangan dokumen :</label>
                                            </div>
                                            <input type="file" name="file" class="form-control my-2" aria-label="Upload gambar">
                                            <div class="invalid-feedback">Silahkan upload gambar kembali</div>

                                            <button type="submit" class="btn btn-outline-primary" name="uploadsave">Simpan</button>
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
                                            <th>Nama File</th>
                                            <th>Nama dokumen</th>
                                            <th>Tanggal</th>
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
                                            $fileupload = mysqli_query($koneksi, "SELECT * FROM upload AND create_add BETWEEN '$mulai' AND DATE_ADD('$akhir', INTERVAL 1 DAY) ORDER BY idupload DESC");
                                        } else {
                                            $fileupload = mysqli_query($koneksi, "SELECT * FROM upload ORDER BY idupload DESC");
                                        }

                                    } else {
                                        // jika tidak ada maka data dikembalikan secara berurutan
                                        $fileupload = mysqli_query($koneksi, "SELECT * FROM upload ORDER BY idupload DESC");
                                    }

                                    while ($fu = mysqli_fetch_array($fileupload)) {
                                        $idup       = $fu['idupload'];   
                                        $nmdokumen  = $fu['nama_dokumen'];
                                        $ket        = $fu['keterangan'];
                                        $tgl        = $fu['create_add'];
                                        $file       = $fu['file'];
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $file; ?></td>
                                            <td><?= $nmdokumen; ?></td>
                                            
                                            <td><?= $tgl; ?></td>
                                            <td><?= $ket; ?></td>
                                            <td>
                                                <a href="downloadfile.php?filename=<?= $file; ?>" class="btn btn-outline-warning btn-sm" title="view file PDF"><i class="fas fa-file-download"></i> Download Pdf</a>
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
