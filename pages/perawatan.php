<?php 
include "../layouts/header.php";
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Form perawatan komputer</h1>
                        <ol class="breadcrumb mb-4">
                            <marquee behavior="" direction=""><li class="breadcrumb-item active">Form perawatan & pengecekkan perangkat</li></marquee>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myLap" title="laporan trouble shooting baru">
                                <i class="fas fa-file"></i> Form baru
                                </button>

                                <!-- The Modal -->
                                    <div class="modal fade" id="myLap">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Form maintenace baru</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="addperawatan.php"> 
                                        <div class="modal-body row g-3">
                                        <div class="col-md-4 position-relative">
                                            <label for="" class="form-label">Lokasi</label>
                                            <select name="lokasi" class="form-control" required>
                                                <option value="" selected>- pilih -</option>
                                                <?php 
                                                $instalasi = mysqli_query($koneksi, "SELECT * FROM instalasi");
                                                while ($i = mysqli_fetch_array($instalasi)) {
                                                ?>
                                                    <option value="<?= $i['idinstalasi']; ?>"><?= $i['instalasi']; ?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="tgl" class="form-label">Tanggal pelaporan</label>
                                            <input type="date" class="form-control" id="tgl" name="tgl" required>
                                            <div class="valid-feedback">Ok !!</div>
                                            <div class="invalid-feedback">Tanggal diisi dengan yang dilaporkan</div>
                                        </div>
                                        <div class="col-md-4">
                                           <label for="">Nama petugas yang mengerjakan</label>
                                           <select name="nama" id="nama" class="form-control mt-2">
                                            <option value="">- pilih -</option>
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
                                        <hr>
                                        <h4>HARDWARE</h4>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="prihal" class="form-label">Perawatan CPU</label>
                                            <input type="text" class="form-control" id="cpu" name="cpu" required>
                                            <div class="invalid-feedback">
                                            Keterangan
                                            </div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="prihal" class="form-label">Perawatan Perangkat</label>
                                            <input type="text" class="form-control" id="perangkat" name="perangkat" required>
                                            <div class="invalid-feedback">
                                            Keterangan (Mouse, Keybord, Monitor, dan printer)
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="kendala" class="form-label">Perawatan kabel</label>
                                            <input type="text" class="form-control" id="kabel" name="kabel" required>
                                            <div class="invalid-feedback">
                                            Keterangan kondisi kabel di komputer
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>SOFTWARE</h4>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="evaluasi" class="form-label">Pengecekkan Sistem Operasi</label>
                                            <input type="text" class="form-control" id="so" name="so" required>
                                            <div class="invalid-feedback">
                                            lakukan pengecekkan menyeluruh dibagian Sistem Operasi
                                            </div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="evaluasi" class="form-label">Pengecekkan Hardisk</label>
                                            <input type="text" class="form-control" id="hardisk" name="hardisk" required>
                                            <div class="invalid-feedback">
                                            lakukan pengecekkan kondisi hardisk
                                            </div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="evaluasi" class="form-label">Pengecekkan Antivirus</label>
                                            <input type="text" class="form-control" id="antivirus" name="antivirus" required>
                                            <div class="invalid-feedback">
                                            diwajibkan menggunakan antivirus disetiap komputer
                                            </div>
                                        </div>
                                        <div class="col-md-6 position-relative was-validated">
                                            <label for="aplikasi" class="form-label">Pengecekkan Aplikasi</label>
                                            <textarea name="aplikasi" id="aplikasi" class="from-control" cols="60" rows="5" required></textarea>
                                            <div class="invalid-feedback">
                                            list jika ada apps yang diluar standar, dan hapus
                                            </div>
                                        </div>
                                        <div class="col-md-4 position-relative was-validated">
                                            <label for="jaringan" class="form-label">Pengecekkan Kabel jaringan</label>
                                            <input type="text" class="form-control" id="jaringan" name="jaringan" required>
                                            <div class="invalid-feedback">
                                            cek kondisi jaringan di komputer
                                            </div>
                                        </div>

                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="addperawatan" class="btn btn-outline-info" data-bs-dismiss="modal"><b>Simpan</b></button>
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
                                            <th>No</th>
                                            <th>Unit/instalasi</th>
                                            <th>Tanggal</th>
                                            <th>Petugas IT</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>         
                                    <tbody>

                                    <?php 
                                    $no=1;
                                    // panggil database
                                    $data = mysqli_query($koneksi,"SELECT * FROM perawatan as p, pegawai as e WHERE e.idpeg=p.idpeg ORDER BY idperawatan DESC");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $idper  = $d['idperawatan'];
                                        $idp    = $d['idpeg'];
                                        $nama   = $d['nama_lengkap'];
                                        $tgl    = $d['tgl'];
                                        $lokasi = $d['lokasi'];

                                    ?>

                                        <tr class=" ">
                                            <td><?= $no++; ?></td>
                                            <td><?= $lokasi; ?></td>
                                            <td><?= date('d-M-Y', strtotime($tgl)); ?></td>
                                            <td><?= $nama; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm">Print</button>
                                                <button class="btn btn-danger btn-sm">hapus</button>
                                            </td>
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