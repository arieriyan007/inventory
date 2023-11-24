<?php
include "../koneksi.php";
include "../cek.php";
?>

<html>
<head>
  <title>Barang Masuk</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <!-- icon -->
  <link rel="shortcut icon" href="../../assets/logo/logo.png">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2 class="text-center mt-4">Barang Masuk</h2>
			<h4 class="text-muted text-center">(Data barang saat ini)</h4>
				<div class="data-tables datatable-dark">
					
                <!-- table -->
                <table id="mauexport" border="2" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal</th>
                                            <th>Qty</th>
                                            <th>Penerima</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php 
                                    $datakeluar = mysqli_query($koneksi, "SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
                                    $no=1;

                                    while ($kl = mysqli_fetch_array($datakeluar)) {
                                    $tanggal    = $kl['tanggal'];
                                    $namabarang = $kl['namabarang'];
                                    $qty        = $kl['qty'];
                                    $penerima   = $kl['penerima'];
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $namabarang; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $penerima; ?></td>
                                        </tr>
                                    
                                    <?php 
                                    }
                                    ?>    
                                        
                                    </tbody>
                                </table>                                 
					<!-- akhir table -->

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