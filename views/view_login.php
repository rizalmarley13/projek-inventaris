
<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width device-width, initial scale 1.0">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/css/style_login.css">
<script src="<?php echo base_url();?>asset/admin/js/jquery-1.12.2.min.js"></script>
<head>
<title>Login</title>

<script type="text/javascript">
	function cekform()
	{
		if(!$("#id_karyawan").val())
		{
			alert('maaf kode pengguna tidak boleh kosong');
			$("#id_karyawan").focus();
			return false;
		}

		if(!$("#password").val())
		{
			alert('maaf password tidak boleh kosong');
			$("#password").focus();
			return false;
		}
	}
</script>


</head>

<body>
	<header>
        <div class="wrapper clearfix">
            <img src="<?php echo base_url();?>asset/admin/img/whitelogo.png" alt="Logo" />
        </div>
    </header>
    <section id="content">
    	<div class="bottom-sp">
            <div class="wrapper clearfix">
                <h1 id="sitetitle">APLIKASI MANAJEMEN INVENTARIS</h1>
            </div>
        </div>
        <div id="form-login">
        <form method="POST" action="<?php echo base_url();?>index.php/login/cek_data">
        	<div class="form-group">
            	<input class="form-control" type="text" name="id_karyawan" id="id_karyawan"  placeholder="Kode Pengguna"/> 
            </div>
        	<div class="form-group">
            	<input class="form-control" type="password" name="password" id="password"  placeholder="Kata Sandi"/>
            </div>
            <div class="form-group">
            	<input class="btn" type="submit" value="Login" onclick="return cekform()" />
            </div> 
        </form>
        </div>
    	<div class="top-sp">
            <div class="wrapper clearfix">
                <div align="center">
                	<p>Waspadai pencurian password, pastikan alamat pada browser adalah<br/><a href="#">https://simi.sttbandung.ac.id</a></p>
                </div>
            </div>
        </div>
    </section>
    <footer>
    	<div class="wrapper clearfix">
        	<div align="center">
            	<p class="copyright">&copy; 2016 - 2026 STT Bandung<br/> Information System Development Center</p>
            </div>
        </div>
    </footer>
</body>
</html>
