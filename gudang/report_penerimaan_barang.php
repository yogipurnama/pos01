<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_gudang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=gudang');
  }
  if(isset($_GET['follow']) and !empty($_GET['follow'])) {
        $kd_penerimaan_barang = $_GET['follow'];
        $get_keterangan = $mysqli->query("SELECT * FROM tbl_penerimaan_barang_header INNER JOIN tbl_supplier ON tbl_penerimaan_barang_header.kd_supplier=tbl_supplier.kd_supplier INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_penerimaan_barang_header.kd_pegawai WHERE tbl_penerimaan_barang_header.kd_penerimaan_barang='$kd_penerimaan_barang'");
        $data_keterangan = $get_keterangan->fetch_array();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Gudang - Report penerimaan_barang</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>
        <link rel="stylesheet" media="print" href="css/print_report.css">
        <style>
            .table th, .table td { 
                 border-top: none !important; 
             }
        </style>
    </head>
    <body class="print-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 left-reset">
                    <h2>Port Replay</h2>
                    <h4>Fashion Remaja</h4>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-xs-12 left-reset">
                    <div class="col-xs-7 left-reset">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Alamat </b></td>
                                    <td>:</td>
                                    <td><?php //echo $data_keterangan['alamat']; ?>Jln. Rancamalang No.99</td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b> </td>
                                    <td>:</td>
                                    <td>081322328888</td>
                                </tr>
                                <tr>
                                    <td><b>Operator</b></td>
                                    <td>:</td>
                                    <td><?php echo $data_keterangan['username']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td>:</td>
                                    <td><?php echo date('Y-m-d'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 left-reset report_heading">
                        <h2 class="text-center title-box">Report penerimaan_barang Barang</h2>
                    </div>
                    <div class="col-xs-12 left-reset">
                        <div class="col-xs-10 left-reset">
                            <div class="col-xs-6 left-reset">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Kode penerimaan_barang</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['kd_penerimaan_barang']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal penerimaan_barang</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['tanggal_penerimaan_barang'];?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pegawai</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['nama']; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6 left-reset">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>supplier </b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['nm_supplier']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['alamat'];?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['email']; ?></td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 left-reset">
                        <table class="table table-bordered table-striped" id="list_barang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity</th>
                                    <th>Diskon</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    $get_daftar_barang = $mysqli->query("SELECT * FROM  tbl_penerimaan_barang_detail INNER JOIN tbl_barang ON tbl_penerimaan_barang_detail.kd_barang=tbl_barang.kd_barang WHERE tbl_penerimaan_barang_detail.kd_penerimaan_barang='$kd_penerimaan_barang'");
                                    while($data_daftar_barang = $get_daftar_barang->fetch_array()) {
                                        $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data_daftar_barang['kd_barang']; ?></td>
                                    <td><?php echo $data_daftar_barang['nm_barang']; ?></td>
                                    <td><?php echo $data_daftar_barang['qty']; ?></td>
                                    <td><?php echo $data_daftar_barang['diskon']; ?></td>
                                    <td><?php echo rupiah($data_daftar_barang['harga']); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-xs-4 text-center">
					Dibuat Oleh<br><br><br><br>(...............................)
				</div>
				<div class="col-xs-4 text-center">
					Disetujui Oleh<br><br><br><br>(...............................)
				</div>
				<div class="col-xs-4 text-center">
					Diterima Oleh<br><br><br><br>(...............................)
				</div>
			</div>
        </div>
		<script>
			window.print();
		</script>
    <?php include 'component/javas.php'; ?>
    </body>
</html>
<?php } ?>