      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header text-center">MAIN NAVIGATION</li>
            <li <?php if(alamat()=='index.php') { ?>class="active" <?php } ?>>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            
            <li class="treeview <?php if(alamat()=='toko.php') { ?>active<?php } ?>">
              <a href="#">
               <i class="fa fa-home"></i> <span>Toko</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php 
                  $get_data_toko = $mysqli->query("SELECT * FROM tbl_pelanggan");
                  while($data_toko_pelanggan = $get_data_toko->fetch_array()){
					if(is_admin($_SESSION['kd_pegawai'])===true){
                ?>

					<li <?php if(get_toko_id()==$data_toko_pelanggan['kd_pelanggan']) {?> class="toko_active" <?php } ?>><a href="toko.php?following=<?php echo $data_toko_pelanggan['kd_pelanggan']; ?>"><?php echo $data_toko_pelanggan['alamat']; ?></a></li>
                
                <?php 
					}else{
					$kd_pegawai = $_SESSION['kd_pegawai'];
					$get_data_pegawai_pelanggan = $mysqli->query("SELECT * FROM tbl_pegawai_pelanggan WHERE kd_pegawai='$kd_pegawai'");
						foreach($get_data_pegawai_pelanggan as $akses){
							if($data_toko_pelanggan['kd_pelanggan'] == $akses['kd_pelanggan']){
				?>
					<li <?php if(get_toko_id()==$data_toko_pelanggan['kd_pelanggan']) {?> class="toko_active" <?php } ?>><a href="toko.php?following=<?php echo $data_toko_pelanggan['kd_pelanggan']; ?>"><?php echo $data_toko_pelanggan['alamat']; ?></a></li>
				<?php
							}
						}
					}
					}
				?>
              </ul>
            </li>
            <li <?php if(alamat()=='terjual.php') { ?>class="active" <?php } ?>>
              <a href="terjual.php"><i class="fa fa-retweet"></i> Terjual</a>
            </li>
            <li <?php if(alamat()=='retur.php') { ?>class="active" <?php } ?>>
              <a href="retur.php"><i class="fa fa-refresh"></i>  Retur Barang <small class="label pull-right bg-red">3</small></a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>