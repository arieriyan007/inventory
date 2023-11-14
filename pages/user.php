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
                                    $idu    = $u['iduser'];
                                    $uname  = $u['username'];
                                    $pass   = $u['password']; 
                                    ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $uname; ?></td>
                                            <td><?= $pass; ?></td>
                                            <td>
                                                    <!-- membuat agar mengedit atau mendelete berdasarkan idbarang -->
                                                <input type="hidden" name="idbarangnya" value="<?= $idb; ?>">

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idu; ?>">
                                                <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                                    <!-- Delete -->
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete<?= $idu; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header Delete-->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Info hapus data user</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body Delete -->
                                                        <form method="POST" action="delete_user.php">
                                                        <div class="modal-body">
                                                            Apakah Ada yakin ingin menghapus user <?= $uname; ?> ?
                                                            <input type="hidden" name="idu" value="<?= $idu; ?>">
                                                            <br>
                                                            <button type="submit" class="btn btn-danger mt-2" name="deleteuser">Delete</button>
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
