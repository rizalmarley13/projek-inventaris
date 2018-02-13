<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">
			<div class="panel panel-heading">
				QR Code
			</div>
			<div class="panel panel-body">
				<?php
				while($row = mysql_fetch_array($q)) {
				?>
				<img src="<?php echo base_url()?>index.php/barang2/tampil_qrcode/id_gambar=<?php echo $row["kode_barang"];?>">	
				<?php 
				}
				?>						
			</div>

		</div>
	</div>	
</div>
</div>