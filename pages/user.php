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
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <marquee behavior="" direction=""><li class="breadcrumb-item active">Data User aplikasi</li></marquee>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myUser">
                                <i class="fas fa-user-plus"></i> User baru
                                </button>

                                <!-- The Modal -->
                                    <div class="modal fade" id="myUser">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah user baru</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="tambahUser.php"> 
                                        <div class="modal-body">
                                            <input type="text" name="uname" id="uname" placeholder="Username/Nama user" class="form-control" autofocus required="required">
                                            <input type="password" name="pass" id="pass1" placeholder="Password" class="form-control my-2" required>
                                            <input type="checkbox" class="form-checkbox" onclick="myFunction()"> Lihat Password
                                            <br>
                                            <button type="submit" class="btn btn-primary" name="addUser">Simpan</button>
                                        </div>
                                        <!-- script untuk lihat password -->
                                            <script>
                                                function myFunction() {
                                                    var x = document.getElementById("pass1");
                                                    if (x.type === "password") {
                                                        x.type = "text";
                                                    } else {
                                                        x.type = "password";
                                                    }
                                                }
                                            </script>
                                        <!-- akhir script lihat password -->
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
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>         
                                    <tbody>

                                    <?php 
                                    $no=1;
                                    // panggil database
                                    $user = mysqli_query($koneksi,"SELECT * FROM login");
                                    while ($u = mysqli_fetch_array($user)) {
                                    $idb    = $u['iduser'];
                                    $uname  = $u['username'];
                                    $pass   = $u['password']; 
                                    ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $uname; ?></td>
                                            <td><?= $pass; ?></td>
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
