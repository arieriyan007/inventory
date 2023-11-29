<?php 
require "koneksi.php";


if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $cekdata = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username' AND password='$password' ");
  
  // hitung jumlah data di login
  $hitung = mysqli_num_rows($cekdata);

  if ($hitung > 0) {
    
    $_SESSION['log'] = 'True';
    $_SESSION['username'] = $username;
    header("location:pages/index.php?status=berhasil");
  } else {
    header("location:index.php?pesan=gagal");
  }
}

// membuat kunci dengan kondisi sudah login maka tidak bisa kembali ke menu login.php
if (!isset($_SESSION['log'])) {
  # code...
} else {
  header("location:pages/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Aplikasi Stock Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/logo/logo.png">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  </head>
  <body class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                    <h3 class="text-center font-weight-light">Stock Barang Ku</h3>
                    <p class="text-muted text-center my-2"><b>Login</b></p>
                  </div>
                  
                  <!-- membuat notifikasi login -->
                  <div class="mt-2 text-center">
                    <?php 
                    if (isset($_GET['pesan'])) {
                      if ($_GET['pesan']=='gagal') {
                        echo "<div class='alert alert-info' role='alert'><b>Username / password Anda Salah !</b></div>";
                      } elseif ($_GET['pesan']=='logout') {
                        echo "<div class='alert alert-danger' role='alert'><b>Anda Telah Logout</b></div>";
                      } elseif ($_GET['pesan']=='logingagal') {
                        echo "<div class='alert alert-warning' role='alert'><strong>Silahkan Login Terlebih dahulu !</strong></div>";
                      }
                    }
                    ?>
                  </div>
                  <!-- akhir notifikasi login -->

                  <div class="card-body">
                    <form method="post">
                      <div class="form-floating mb-3">
                        <input class="form-control" name="username" id="inputUsername" type="text" placeholder="Username" required />
                        <label for="inputUsername">Username</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required/>
                        <label for="inputPassword">Password</label>
                      </div>
                      <!-- <div class="form-check mb-3">
                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                      </div> -->
                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                        <button class="btn btn-primary" name="login">Login</button>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer text-center py-3">
                    <div class="small"><a href="https://arieriyan007.github.io">Support By Tim IT</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
      <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; https://arieriyan007.github.io</div>
              <div>
                <a href="https://areiriyan007.github.io">Support By</a>
                &middot;
                <a href="https://areiriyan007.github.io">Arieriyan &amp; Tim</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
