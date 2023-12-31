<?php 
include "../layouts/header.php";
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Laporan Pekerjaan IT</h1>
                        <ol class="breadcrumb mb-4">
                            <marquee behavior="" direction=""><li class="breadcrumb-item active">Aktivitas pekerjaan selesai</li></marquee>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myLap" title="laporan trouble shooting baru">
                                <i class="fas fa-file"></i> Lap baru
                                </button>

                                <!-- The Modal -->
                                    <div class="modal fade" id="myLap">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Pelaporan baru</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="tambahaktiv.php" enctype="multipart/form-data"> 
                                        <div class="modal-body row g-3">
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="laporan" class="form-label">No Laporan</label>
                                            <input type="number" class="form-control" id="laporan" name="nolap" required>
                                            <div class="valid-feedback">Ok !!</div>
                                            <div class="invalid-feedback">Data harus berupa angka</div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="lokasi" class="form-label">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                            <div class="valid-feedback">Ok !!</div>
                                            <div class="invalid-feedback">Data harus sesuai instalasi/unit yg dilaporkan</div>
                                        </div>
                                        <div class="col-md-4">
                                           <label for="">Nama petugas</label>
                                           <select name="nama" id="nama" class="form-control mt-2">
                                            
                                            <?php 
                                            $datapegawai = mysqli_query($koneksi, "SELECT * FROM pegawai");
                                            while ($d = mysqli_fetch_array($datapegawai)) {
                                                $idp = $d['idpeg'];
                                                $nama = $d['nama_lengkap'];
                                            ?>
                                                <option value="<?= $idp; ?>"><?= $nama; ?></option>
                                            <?php 
                                            }
                                            ?>
                                           </select>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="prihal" class="form-label">Prihal laporan</label>
                                            <input type="text" class="form-control" id="prihal" name="prihal" required>
                                            <div class="invalid-feedback">
                                            Jenis nama laporan
                                            </div>
                                        </div>
                                        <!-- keterangan menggunakan textarea -->
                                        <div class="form-floating col-md-8 position-relative">
                                            <textarea class="form-control mt-4" name="ket" placeholder="Keterangan" id="floatingTextarea2" style="height: 60px"></textarea>
                                            <label for="floatingTextarea2" class="mt-4">Keterangan pelaporan pekerjaan :</label>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="kendala" class="form-label">Kendala</label>
                                            <input type="text" class="form-control" id="kendala" name="kendala" required>
                                            <div class="invalid-feedback">
                                            Kendala di lapangan
                                            </div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="evaluasi" class="form-label">Evaluasi</label>
                                            <input type="text" class="form-control" id="evaluasi" name="evaluasi" required>
                                            <div class="invalid-feedback">
                                            Evaluasi yang disampaikan dilapangan !
                                            </div>
                                        </div>
                                        <div class="form-floating col-md-4">
                                            <input type="date" id="tglSelesai" class="form-control mt-4" name="tglSelesai" required>
                                            <label for="tglSelesai" class="mt-4">Tanggal Selesai :</label>
                                        </div>
                                        <div class="col-md-3 was-validated">
                                        <label for="Status" class="form-label">Status pekerjaan :</label>
                                        <select class="form-select" name="status" required>
                                            <option value=""> - pilih - </option>
                                            <option value="Selesai">Selesai</option>
                                            <option value="Pending">Pending</option>
                                            </select>
                                            <div class="invalid-feedback">silahkan pilih status pekerjaan saat ini</div>
                                        </div>
                                        <!-- memasukkan gambar img -->
                                        <div class="col-md-4 was-validated">
                                            <label for="img">Masukkan foto :</label>
                                            <input type="file" name="img" id="img" class="form-control mt-2" required>
                                        </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="addAktivitas" class="btn btn-outline-info" data-bs-dismiss="modal"><b>Simpan</b></button>
                                        </div>
                                       
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- akhir notifikasi barang -->
                            <div class="card-body">
                                <table id="datatablesSimple" border="2" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No laporan</th>
                                            <th>Gambar</th>
                                            <th>Lokasi</th>
                                            <th>Tgl laporkan</th>
                                            <th>status</th>
                                            <th>Tgl selesai</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>         
                                    <tbody>

                                    <?php 
                                    // $no=1;
                                    // panggil database
                                    $data = mysqli_query($koneksi,"SELECT * FROM aktivitas_lap");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $idl    = $d['idlap'];
                                        $nolap = $d['no_lap'];
                                        $namalap = $d['nama_laporan'];
                                        $lokasi = $d['lokasi'];
                                        $tgl_lap = $d['tgl_start'];
                                        $status = $d['status'];
                                        $tgl_selesai = $d['tgl_selesai'];

                                        $gambar = $d['image'];
                                        if ($gambar == null) {
                                            $img = 'No Gambar';
                                        } else {
                                            $img = '<img src="../assets/img_laporan/'.$gambar.'" width="100" height="100" >';
                                        }
                                    ?>

                                        <tr class=" ">
                                            <td><?= $nolap; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><?= $lokasi; ?></td>
                                            <td><?= $tgl_lap; ?></td>
                                            <td><?= $status; ?></td>
                                            <td><?= $tgl_selesai; ?></td>
                                            <td>
                                                <?php 
                                                if ($status=='Pending') {
                                                    echo '<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#selesai'.$idl.'">
                                                    <i class="fas fa-hourglass-end"></i> Selesai
                                                    </button>';
                                                } else {
                                                    // jika status selesai
                                                    echo '';
                                                }
                                                ?>
                                               
                                                    <!-- membuat agar mengedit atau mendelete berdasarkan idbarang -->
                                                <input type="hidden" name="idbarangnya" value="<?= $idb; ?>">

                                                <button type="button" class="btn btn-warning btn-sm my-1" data-bs-toggle="modal" data-bs-target="#print<?= $idl; ?>">
                                                <i class="fas fa-print"></i> Print
                                                </button>
                                            </td>
                                        </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="selesai<?= $idl; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Edit-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Pending pekerjaan</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Edit -->
                                                        <!-- menambahkan enctype="multipart/form-data" -->
                                                        <form method="POST" action="editIndex.php"  enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <p>Apakah yakin pekerjaan <?= $namalap; ?> sudah selesai</p>
                                                            
                                                            <!-- lakukan parshing id lapangan -->
                                                            <input type="hidden" name="idl" value="<?= $idl; ?>">

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
                                                        <form method="POST" action="tambah_barang.php">
                                                        <div class="modal-body">
                                                            Apakah Ada yakin ingin menghapus <?= $namabarang; ?> ?
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