<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Manajemen Inventaris</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()."asset/admin/css/bootstrap.min.css"; ?>" rel="stylesheet" type="text/css" media="screen">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()."asset/admin/css/metisMenu.min.css"; ?>" rel="stylesheet" type="text/css">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url()."asset/admin/css/timeline.css"; ?>" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()."asset/admin/css/sb-admin-2.css"; ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/admin/css/sidebarstyle.css";?>" rel="stylesheet">

    <!-- CSS tabel -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/css/dataTables.bootstrap.min.css">

    <!-- CSS Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assert/admin/sweetalert-master/dist/sweetalert.css">

    <!-- Morris Charts CSS -->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()."asset/admin/css/font-awesome.min.css"; ?>" rel="stylesheet" type="text/css">

    <!--CSS datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

    <!--CSS jquery UI-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/admin/jquery-ui-1.12.0.custom/jquery-ui.min.css";?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>
	<div class="head">
		<img src="<?php echo base_url()."asset/admin/img/headlogo1.png";?>">
	</div>

    <div id="wrapper">

        <!-- Navigation -->

        <?php 
        if($this->session->userdata('level')=="Admin"){
            echo $this->load->view('home/view_menu');
        }else if($this->session->userdata('level')=="Kepala Bagian"){
            echo $this->load->view('home/view_menu_kepala');
        }else{
            echo $this->load->view('home/view_menu_petugas');
        }
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12">

                    <h1 class="page-header position-relative">
                    	<?php echo $judul;?>
                    <small>
                    	<i class="fa fa-arrow-right fa-fw"></i>
                    	<?php echo $subjudul;?>
                    </small>
                    </h1>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <?php echo $this->load->view($content); ?>
            
    </div>
    </div>
    <!-- /#wrapper -->
    <br>
    <br>
    <br>
    <br>
    <footer>
        <div class="wrapper clearfix">
            <div align="center">
                <p class="copyright">&copy; 2016 - 2026 STT Bandung<br/> Information System Development Center</p>
            </div>
        </div>
    </footer>
    </body>

    <!-- jQuery -->
    <script src="<?php echo base_url()."asset/admin/js/jquery-2.2.3.min.js";?>"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()."asset/admin/js/bootstrap.min.js";?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()."asset/admin/js/metisMenu.min.js";?>"></script>
    <script src="<?php echo base_url()."asset/admin/jquery-ui-1.12.0.custom/jquery-ui.min.js";?>"></script>

    <!-- Morris Charts JavaScript -->
   
    <!-- javascript sweetalert -->
    <script src="<?php echo base_url();?>asset/admin/sweetalert-master/dist/sweetalert.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()."asset/admin/js/sb-admin-2.js";?>"></script>

    <!--Tabel Java Script-->
    <script src="<?php echo base_url();?>asset/admin/js/jquery.dataTables.min.js"></script>
    <!--Datetime-picker-->
    <script src="<?php echo base_url();?>asset/admin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
                    
            //memanggil plugin datetimepicker
            $(document).ready(function(){
                $('.tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: "top auto",
                    todayBtn: true,
                    todayHighlight: true,
                });

                //memanggil plugin autocomplete permintaan
                $("#kode").autocomplete({
                minLenght:0,
                delay:0,
                source:"<?php echo site_url('permintaan/get_databarang');?>",
                select:function(even, ui){
                    $("#kode_barang").val(ui.item.kode_barang);
                    $("#nama_barang").val(ui.item.nama_barang);
                    $("#jumlah").val(ui.item.jumlah);
                    $("#satuan").val(ui.item.satuan);
                    $("#jumlah_diminta").focus();
                    }   
                });

                //memanggil plugin autocomplete mutasi
                $("#barang_mutasi").autocomplete({
                minLenght:0,
                delay:0,
                source:"<?php echo site_url('permintaan/get_databarang');?>",
                select:function(even, ui){
                    $("#kode_barang").val(ui.item.kode_barang);
                    $("#nama_barang").val(ui.item.nama_barang);
                    $("#merk").val(ui.item.merk);
                    $("#versi").val(ui.item.versi);
                    $("#jumlah").val(ui.item.jumlah);
                    $("#satuan").val(ui.item.satuan);
                    }   
                });

                //memanggil plugin autocomplete input letak barang
                $("#letak_barang").autocomplete({
                minLenght:0,
                delay:0,
                source:"<?php echo site_url('mutasi/get_barang_letak_brg');?>",
                select:function(even, ui){
                    $("#kode_barang").val(ui.item.kode_barang);
                    $("#nama_barang").val(ui.item.nama_barang);
                    $("#merk").val(ui.item.merk);
                    $("#versi").val(ui.item.versi);
                    $("#satuan").val(ui.item.satuan);
                    }   
                });



                // $('#kode_barang').change(function(){
                //     var kode_barang = $("#kode_barang").val();

                //     $.ajax({
                //         url:"<?php echo site_url('barang2/cek');?>",
                //         data:{kode_barang:kode_barang},
                //         success : function(result){
                //             if(result == 0){
                //                 $("#pesan").html('kode barang bisa digunakan');
                //                 $("#kode_barang").css('border','3px #090 solid');
                //             }else{
                //                 $("#pesan").html('kode barang sudah ada');
                //                 $("#kode_barang").css('border','3px #c33 solid');
                //             }
                //         }
                //     });
                // });

                // memanggil detail barang pada permintaan
                $("#kode_barang").change(function(){
                var kode_barang = $("#kode_barang").val();
                var qty = $("#qty").val();
                $.ajax({
                    type: "POST",
                    url : "<?php echo site_url('permintaan/get_detail_barang'); ?>",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function(data){
                    $('#detail_barang').html(data);
                    document.frm.add.disabled=false;
                    }
                    });
                $("#qty").focus();
                });

                // memanggil detail barang pada letak barang
                $("#kode_barang_letak").change(function(){
                var kode_barang = $("#kode_barang_letak").val();
                var jumlah = $("#jumlahbrg").val();
                $.ajax({
                    type: "POST",
                    url : "<?php echo site_url('letak_barang/get_detail_barang'); ?>",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function(data){
                    $('#detail_barang').html(data);
                    document.frm.add.disabled=false;
                    }
                    });
                $("#jumlahbrg").focus();
                });

                //menghapus items cart pada proses permintaan (Belum Bisa)
                $(".delbutton").click(function(){
                var element = $(this);
                var del_id = element.attr("id");
                var info = del_id;
                if(confirm("Anda yakin akan menghapus?"))
                    {
                    $.ajax({
                        url: "<?php echo base_url(); ?>permintaan/hapus_pengadaan",
                        data: "kode="+info,
                        cache: false,
                        success: function(){
                        }
                        });
                    $(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
                    }
                return false;
                });

            });

            //menampilkan data detail pengadaan pada modal(modal dinamis)
            $(".data-detail").click(function(e){
                var rowid = $(this).attr("data-id");
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('pengadaan/get_detail_pengadaan') ;?>",
                    data : "rowid="+rowid,
                    success : function(data){
                        $(".fetched-data").html(data);
                        $("#modalDetail").modal('show');
                    }
                });


            });

            //validasi inputan angka
            $("#jumlah").keypress(function(data){
            if (data.which!=8 && data.which!=0 && (data.which < 48 || data.which > 75)) {
                $("#pesan1").html("Isikan Angka").show().fadeOut(3000);
                return false;
                }
            });

            $("#harga_beli").keypress(function(data){
            if (data.which!=8 && data.which!=0 && (data.which < 48 || data.which > 75)) {
                $("#pesan2").html("Isikan Angka").show().fadeOut(3000);
                return false;
                }
            });

            // $(function(){
            //     $(document).on('click','.data-detail', function(e){
            //         e.preventDefault();
            //         $("#modalDetail").modal('show');
            //         var rowid = $(this).attr('data-id');
            //         $.ajax({
            //             type : "POST",
            //             url : "<?php echo site_url('pengadaan/get_detail_pengadaan'); ?>",
            //             data : "rowid="+rowid,
            //             success : function(data){
            //                 $('.fetched-data').html(data);
            //             }  
            //         });
            //     });
            // });

            setInterval(function(){
            $("#load_row").load("<?php echo site_url('home/load_row');?>")
            }, 30000); //menggunakan setinterval jumlah notifikasi akan selalu update tiap 30 detik

            setInterval(function(){
            $("#load_data").load("<?php echo site_url('home/load_data');?>")
            }, 30000); //untuk cek isi data notifikasi

            $("#tabel").dataTable(); // memanggil plugin datatable untuk semua tabel
            
        </script>

</body>

</html>
