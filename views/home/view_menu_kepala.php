<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url()?>index.php/home">SiMi STT-BANDUNG</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> 
                        <span class="badge badge-danger" id="load_row">
                        <?php foreach ($jmlnotif as $rownotif) {
                            echo $jml_notif = $rownotif->jml_notif;
                        } 
                        ?>
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" id="load_data">
                        <li>
                            <a>
                                <?php if (empty($notifikasi)) {
                                    echo "Tidak ada notifikasi"; 
                                } else {
                                foreach ($notifikasi as $rnotif) { ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>index.php/pengadaan/get_notifikasi/<?php echo $rnotif->id_notif?>">
                               <div>
                                <?php echo $bagian = $rnotif->bagian;?><br>
                                <small><b><?php echo $nama_karyawan = $rnotif->nama_karyawan;?></b> <?php echo timeAgo($rnotif->waktu);?></small> 
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                         <?php }} ?>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i> <?php echo $this->session->userdata('nama_karyawan');?>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>index.php/user"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>index.php/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url();?>index.php/home"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>index.php/pengadaan">Pengadaan Barang / Jasa</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>index.php/barang_kepala">Data Barang</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>index.php/pengadaan/tampil_datapengadaan">Data Pengadaan</a>
                                </li>
                            </ul>
                        </li>
                            <!-- /.nav-second-level -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>