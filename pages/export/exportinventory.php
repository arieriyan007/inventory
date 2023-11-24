<?php
include "../../koneksi.php";
include "../../cek.php";
?>

<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<style>
        .zoomable {
            width: 100px;
        }
        .zoomable:hover {
            transform: scale(2);
            transition: 0.8s ease;
        }
    </style>
<body>
<div class="container">
			<h2 class="text-center mt-4">Data Inventory IT</h2>
			<h4 class="text-muted text-center">Instalasi Teknologi & Informasi RSMP</h4>
				<div class="data-tables datatable-dark">
					
                <table id="mauexport" border="2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No Inv</th>
                                            <th>Images</th>
                                            <th>Nama Barang</th>
                                            <th>Merk barang</th>
                                            <th>Tgl Pembelian</th>
                                            <th>Posisi barang</th>  
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
                                        $img = '<img src="../../assets/img/'.$gambar.' " class="zoomable">'; //diarahkan ke tempat penyimpanan gambar
                                    }
                                    
                                     ?>

                                        <tr>
                                            <td><?= $noinv; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><?= $nmbarang; ?></td>
                                            <td><?= $merk; ?></td>
                                            <td><?= $tgl; ?></td>
                                            <td><?= $inst; ?></td>
                                        </tr>
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
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>